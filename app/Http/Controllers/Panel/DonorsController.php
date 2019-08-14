<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Donor;
use App\Donee;
use App\Drivers\Time;

class DonorsController extends Controller
{
  public function index()
  {
    return view('panel.admin.donors.index');
  }
  public function fetch(Request $request)
  {
    $donors = Donor::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->offset($request->input('page', 0) * 10)
      ->limit($request->input('limit', 10))
      ->Active()
      ->with('donees')
      ->get();
    return $donors;
  }
  public function count(Request $request)
  {
    $count = Donor::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->Active()
      ->count();
    return $count;
  }
  public function fetch_deactivate(Request $request)
  {
    $donors = Donor::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->offset($request->input('page', 0) * 10)
      ->limit($request->input('limit', 10))
      ->Deactive()
      ->get();
    return $donors;
  }
  public function count_deactivate(Request $request)
  {
    $count = Donor::where('full_name', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orWhere('national_id', 'LIKE', '%' . $request->input('term', '') . '%')
      ->Deactive()
      ->count();
    return $count;
  }
  public function create()
  {
    return view('panel.admin.donors.create', [
      'donees' => Donee::select('id', 'full_name')->get()
    ]);
  }
  public function store(Request $request)
  {
    // store donor
    $donor = new Donor;
    $donor->full_name = $request->full_name;
    $donor->father_name = $request->father_name;
    $donor->birth_certificate_id = $request->birth_certificate_id;
    $donor->national_id = $request->national_id;
    $donor->nationality = $request->nationality;
    $donor->state = $request->state;
    $donor->city = $request->city;
    $donor->phone = $request->phone;
    $donor->mobile = $request->mobile;
    $donor->marital_status = $request->marital_status;
    $donor->religion = $request->religion;
    $donor->education = $request->education;
    $donor->job = $request->job;
    $donor->cooperation_start_date = Time::jmktime("00", "00", "12", explode("-", $request->cooperation_start_date)[2], explode("-", $request->cooperation_start_date)[1], explode("-", $request->cooperation_start_date)[0]);
    $donor->gender = $request->gender;
    $donor->birth_date = Time::jmktime("00", "00", "12", explode("-", $request->birth_date)[2], explode("-", $request->birth_date)[1], explode("-", $request->birth_date)[0]);
    $donor->address = $request->address;
    $donor->duration_of_support = $request->duration_of_support;
    $donor->save();

    if ($request->has('donees')) {
      foreach ($request->donees as $donee) {
        $donor->donees()->attach(
          [
            $donee["id"] => [
              'donation_type' => $donee["type"],
              'money_amount' => $donee["money"],
              'non_money_detail' => $donee["no_money"],
            ]
          ]
        );
      }
    }

    return redirect()->route('donors.index');
  }
  public function edit(Donor $donor)
  {
    return view('panel.admin.donors.edit', [
      'donor' => $donor,
      'all_donees' => Donee::select('id', 'full_name')->get()
    ]);
  }
  public function update(Request $request, Donor $donor)
  {
    $donor->full_name = $request->full_name;
    $donor->father_name = $request->father_name;
    $donor->birth_certificate_id = $request->birth_certificate_id;
    $donor->national_id = $request->national_id;
    $donor->nationality = $request->nationality;
    $donor->state = $request->state;
    $donor->city = $request->city;
    $donor->phone = $request->phone;
    $donor->mobile = $request->mobile;
    $donor->marital_status = $request->marital_status;
    $donor->religion = $request->religion;
    $donor->education = $request->education;
    $donor->job = $request->job;
    $donor->cooperation_start_date = Time::jmktime("00", "00", "12", explode("-", $request->cooperation_start_date)[2], explode("-", $request->cooperation_start_date)[1], explode("-", $request->cooperation_start_date)[0]);
    $donor->gender = $request->gender;
    $donor->birth_date = Time::jmktime("00", "00", "12", explode("-", $request->birth_date)[2], explode("-", $request->birth_date)[1], explode("-", $request->birth_date)[0]);
    $donor->address = $request->address;
    $donor->duration_of_support = $request->duration_of_support;
    $donor->save();


    if ($request->has('donees')) {
      $donor->donees()->detach();
      foreach ($request->donees as $donee) {
        $donor->donees()->attach(
          [
            $donee["id"] => [
              'donation_type' => $donee["type"],
              'money_amount' => $donee["money"],
              'non_money_detail' => $donee["no_money"],
            ]
          ]
        );
      }
    } else {
      $donor->donees()->detach();
    }

    return redirect()->route('donors.index');
  }

  public function deactivate(Request $request, Donor $donor)
  {
    $donor->status = Donor::DEACTIVE;
    $donor->save();
    $donor->donees()->detach();
    return redirect()->route('donors.index');
  }

  public function activate(Donor $donor)
  {
    $donor->status = Donor::ACTIVE;
    $donor->save();
    return redirect()->route('donors.index');
  }
}
