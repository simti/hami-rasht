<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;

class ReportController extends Controller
{
    public function print_transactions(Request $request){
      if($request->period == 0){
        $transactions = Transaction::where(['type'=>Transaction::CASH])->get();
      }else{
        $transactions = Transaction::where(['type'=>Transaction::CASH,'period_id'=>$request->period])->get();
      }
      // return $transactions;
      return view('panel.admin.reports.prints.transactions',[
        'transactions' => $transactions,
        'total' => sizeof($transactions),
        'per_page' => 2
      ]);
    }

    public function print_recites(Request $request){
      if($request->period == 0){
        $transactions = Transaction::where(['type'=>Transaction::CASH])->get();
      }else{
        $transactions = Transaction::where(['type'=>Transaction::CASH,'period_id'=>$request->period])->get();
      }
      // return $transactions;
      return view('panel.admin.reports.prints.recites',[
        'transactions' => $transactions,
        'total' => sizeof($transactions),
        'per_page' => 4
      ]);
    }

    public function bank_outputs(){

    }
}
