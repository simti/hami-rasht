<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drivers\Time;
use App\Donee;
use App\Donor;

class DoneesController extends Controller
{
  public function index()
  {
    return view('panel.admin.donees.index');
  }
  public function fetch(Request $request)
  {
    $donees = Donee::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->offset($request->input('page', 0) * 10)
      ->limit($request->input('limit', 10))
      ->Active()
      ->get();
    return $donees;
  }
  public function count(Request $request)
  {
    $count = Donee::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->Active()
      ->count();
    return $count;
  }
  public function fetch_deactivate(Request $request)
  {
    $donees = Donee::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->offset($request->input('page', 0) * 10)
      ->limit($request->input('limit', 10))
      ->Deactive()
      ->get();
    return $donees;
  }
  public function count_deactivate(Request $request)
  {
    $count = Donee::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->Deactive()
      ->count();
    return $count;
  }
  public function create()
  {
    return view('panel.admin.donees.create', [
      'donors' => Donor::select('id', 'full_name')->get()
    ]);
  }
  public function store(Request $request)
  {
    // return $request->all();
    $donee = new Donee;
    $donee->file_number = $request->file_number;
    $donee->full_name = $request->full_name;
    $donee->father_name = $request->father_name;
    $donee->birth_date = Time::jmktime("00", "00", "12", explode("-", $request->birth_date)[2], explode("-", $request->birth_date)[1], explode("-", $request->birth_date)[0]);
    $donee->birth_certificate_id = $request->birth_certificate_id;
    $donee->national_id = $request->national_id;
    $donee->bank_account_number = $request->bank_account_number;
    $donee->bank_card_number = $request->bank_card_number;
    $donee->bank_account_owner = $request->bank_account_owner;
    $donee->bank_name = $request->bank_name;
    $donee->bank_branch_name = $request->bank_branch_name;
    $donee->education = $request->education;
    $donee->gender = $request->gender;
    $donee->membership_start_date = Time::jmktime("00", "00", "12", explode("-", $request->membership_start_date)[2], explode("-", $request->membership_start_date)[1], explode("-", $request->membership_start_date)[0]);
    $donee->address = $request->address;
    $donee->phone = $request->phone;
    $donee->mobile = $request->mobile;
    $donee->organization_branch = $request->organization_branch;
    $donee->number_of_disabled_members_in_family = $request->number_of_disabled_members_in_family;
    $donee->number_of_family_members = $request->number_of_family_members;
    $donee->disabled = $request->disabled;
    $donee->reasons_to_help = $request->reasons_to_help;
    $donee->save();

    if ($request->has('donors')) {
      foreach ($request->donors as $donor) {
        $donee->donors()->attach(
          [
            $donor["id"] => [
              'donation_type' => $donor["type"],
              'money_amount' => $donor["money"],
              'non_money_detail' => $donor["no_money"],
            ]
          ]
        );
      }
    }

    return redirect()->route('donees.index');
  }
  public function edit(Request $request, Donee $donee)
  {
    return view('panel.admin.donees.edit', [
      'donee' => $donee,
      'all_donors' => Donor::select('id', 'full_name')->get()
    ]);
  }
  public function update(Request $request, Donee $donee)
  {
    $donee->file_number = $request->file_number;
    $donee->full_name = $request->full_name;
    $donee->father_name = $request->father_name;
    $donee->birth_date = Time::jmktime("00", "00", "12", explode("-", $request->birth_date)[2], explode("-", $request->birth_date)[1], explode("-", $request->birth_date)[0]);
    $donee->birth_certificate_id = $request->birth_certificate_id;
    $donee->national_id = $request->national_id;
    $donee->bank_account_number = $request->bank_account_number;
    $donee->bank_card_number = $request->bank_card_number;
    $donee->bank_account_owner = $request->bank_account_owner;
    $donee->bank_name = $request->bank_name;
    $donee->bank_branch_name = $request->bank_branch_name;
    $donee->education = $request->education;
    $donee->gender = $request->gender;
    $donee->membership_start_date = Time::jmktime("00", "00", "12", explode("-", $request->membership_start_date)[2], explode("-", $request->membership_start_date)[1], explode("-", $request->membership_start_date)[0]);
    $donee->address = $request->address;
    $donee->phone = $request->phone;
    $donee->mobile = $request->mobile;
    $donee->organization_branch = $request->organization_branch;
    $donee->number_of_disabled_members_in_family = $request->number_of_disabled_members_in_family;
    $donee->number_of_family_members = $request->number_of_family_members;
    $donee->disabled = $request->disabled;
    $donee->reasons_to_help = $request->reasons_to_help;
    $donee->save();

    if ($request->has('donors')) {
      $donee->donors()->detach();
      foreach ($request->donors as $donor) {
        $donee->donors()->attach(
          [
            $donor["id"] => [
              'donation_type' => $donor["type"],
              'money_amount' => $donor["money"],
              'non_money_detail' => $donor["no_money"],
            ]
          ]
        );
      }
    } else {
      $donee->donors()->detach();
    }
    return redirect()->route('donees.index');
  }

  public function deactivate(Request $request,Donee $donee){
    $donee->status = Donee::DEACTIVE;
    $donee->save();
    $donee->donors()->detach();
    return redirect()->route('donees.index');
  }

  public function activate(Donee $donee){
    $donee->status = Donee::ACTIVE;
    $donee->save();
    return redirect()->route('donees.index');
  }
}
