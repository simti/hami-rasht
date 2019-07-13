<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Donor;
use App\Transaction;

class TransactionsController extends Controller
{
  public function index()
  {
    return view('panel.admin.transactions.index');
  }
  public function fetch(Request $request)
  {
    $transactions = Transaction::whereHas('donor',function($query) use ($request){
        $query->where('full_name', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->orWhereHas('donee',function($query) use($request){
        $query->where('full_name', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->orWhereHas('donor',function($query) use($request){
        $query->where('national_id', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->orWhereHas('donee',function($query) use($request){
        $query->where('national_id', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->offset($request->input('page', 0) * 10)
      ->limit($request->input('limit', 10))
      ->with(
        [
          'donor'=>function($query){
          $query->select('id','full_name','national_id');
          },
          'donee'=>function($query){
          $query->select('id','full_name','national_id');
          },
          'period'=>function($query){
            $query->select('id','title');
          },
        ]
        )
      ->get();
    return $transactions;
  }
  public function count(Request $request)
  {
    $count = Transaction::whereHas('donors',function($query){
        $query->where('full_name', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->whereHas('donees',function($query){
        $query->where('full_name', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->whereHas('donor',function($query) use($request){
        $query->where('national_id', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->whereHas('donee',function($query) use($request){
        $query->where('national_id', 'LIKE', '%' . $request->input('term', '') . '%');
      })
      ->count();
    return $count;
  }
  public function create()
  {
    if(Donor::has('donees')->Active()->count()>0){
      return view('panel.admin.transactions.create');
    }else{
      return back()->withErrors(['transaction', 'ابتدا باید حامی ای ساخته و مددجویی به آن اضافه کنید']);
    }
  }
  public function update(Request $request, Transaction $transaction)
  {
    $transaction->type = $request->type;
    $transaction->money_amount = $request->type==1?$request->money_amount:0;
    $transaction->non_money_detail = $request->type==1?'null':$request->non_money_detail;
    $transaction->save();
    return redirect()->route('transactions.index');
  }
  public function edit(Transaction $transaction){
    return view('panel.admin.transactions.edit',[
      'transaction' => $transaction
    ]);
  }
  public function fetch_related_donees(Request $request)
  {
    return Donor::find($request->id)->donees;
  }
  public function fetch_info(Request $request)
  {
    $donor = Donor::find($request->donor_id);
    return $donor->donees()->where('donee_id', $request->donee_id)->first();
  }
  public function store(Request $request)
  {
    if (Transaction::where(["donor_id" => $request->donor, "donee_id" => $request->donee, "period_id" => $request->period])->first())
      return 'already existed!';

    $transaction = new Transaction;
    $transaction->donor_id = $request->donor;
    $transaction->donee_id = $request->donee;
    $transaction->period_id = $request->period;
    $transaction->type = $request->type;
    $transaction->money_amount = $request->money;
    $transaction->non_money_detail = $request->non_money;
    $transaction->save();
    return 'saved';
  }
}
