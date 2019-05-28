<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Donor;

class TransactionsController extends Controller
{
  public function index()
  { }
  public function create()
  {
    return view('panel.admin.transactions.create');
  }

  public function fetch_related_donees(Request $request){
    return Donor::find($request->id)->donees;
  }
  public function fetch_info(Request $request){
    $donor = Donor::find($request->donor_id);
    return $donor->donees()->where('donee_id',$request->donee_id)->first();
  }
  public function store(Request $request)
  {

    $donee = new Donee;

    $donor = Donor::find($request->donors);
    $donee->donors()->attach($donor);

    return 'Success';

  }

}
