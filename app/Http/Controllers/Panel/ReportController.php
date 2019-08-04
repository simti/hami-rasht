<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Period;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
  public function print_transactions(Request $request)
  {
    if ($request->period == 0) {
      $year = "همه";
      $month = "همه";
      if ($request->output_type == 0) {
        $transactions = Transaction::where(['type' => Transaction::CASH])->get();
      } elseif ($request->output_type == Transaction::BANK) {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::BANK])->get();
      } else {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::NO_BANK])->get();
      }
    } else {
      $year = explode("-",Period::findOrFail($request->period)->title)[0];
      $month = explode("-",Period::findOrFail($request->period)->title)[1];
      if ($request->output_type == 0) {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'period_id' => $request->period])->get();
      } elseif ($request->output_type == Transaction::BANK) {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'period_id' => $request->period, 'output_type' => Transaction::BANK])->get();
      } else {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'period_id' => $request->period, 'output_type' => Transaction::NO_BANK])->get();
      }
    }

    return view('panel.admin.reports.prints.transactions', [
      'transactions' => $transactions,
      'total' => sizeof($transactions),
      'per_page' => 16,
      'year' => $year,
      'month'=>$month
      
    ]);
  }

  public function print_recites(Request $request)
  {
    if ($request->period == 0) {
      if ($request->output_type == 0) {
        $transactions = Transaction::where(['type' => Transaction::CASH])->get();
      } elseif ($request->output_type == Transaction::BANK) {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::BANK])->get();
      } else {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::NO_BANK])->get();
      }
    } else {
      if ($request->output_type == 0) {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'period_id' => $request->period])->get();
      } elseif ($request->output_type == Transaction::BANK) {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'period_id' => $request->period, 'output_type' => Transaction::BANK])->get();
      } else {
        $transactions = Transaction::where(['type' => Transaction::CASH, 'period_id' => $request->period, 'output_type' => Transaction::NO_BANK])->get();
      }
    }
    // return $transactions;
    return view('panel.admin.reports.prints.recites', [
      'transactions' => $transactions,
      'total' => sizeof($transactions),
      'per_page' => 4
    ]);
  }

  public function bank_output(Request $request)
  {
    if ($request->period == 0) {
      $transactions = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::BANK])->get();
      $transactions_sum = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::BANK])->sum('money_amount');
    } else {
      $transactions = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::BANK, 'period_id' => $request->period])->get();
      $transactions_sum = Transaction::where(['type' => Transaction::CASH, 'output_type' => Transaction::BANK, 'period_id' => $request->period])->sum('money_amount');
    }


    if (sizeof($transactions) > 0) {
      $file_name = str_random(6) . "-" . $transactions[0]->period->title;

      // total count
      $total_count = "";
      for ($i = 0; $i < (10 - strlen((string) sizeof($transactions))); $i++)
        $total_count .= "0";
      $total_count .= (string) sizeof($transactions);

      // total money
      $total_money = "";
      for ($i = 0; $i < (15 - strlen((string) $transactions_sum)); $i++)
        $total_money .= "0";
      $total_money .= (string) $transactions_sum;
      // $count = sizeof($transactions);

      File::put(storage_path('app/outputs/' . $file_name . ".PAY"), $total_count . $total_money . "\n");

      foreach ($transactions as $tr) {
        //account number
        $bank_account = "";
        for ($i = 0; $i < (10 - strlen((string) $tr->donee->bank_account_number)); $i++)
          $bank_account .= "0";
        $bank_account .= (string) $tr->donee->bank_account_number;
        //money amout
        $amount = "";
        for ($i = 0; $i < (15 - strlen((string) $tr->money_amount)); $i++)
          $amount .= "0";
        $amount .= (string) $tr->money_amount;

        //append to file
        File::append(storage_path('app/outputs/' . $file_name . ".PAY"), $bank_account . $amount . "\n");
      }
      return Response::download(storage_path("app\outputs\\" . $file_name . ".PAY"));
      return back();
    }
  }
}
