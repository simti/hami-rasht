<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drivers\Time;
use Carbon\Carbon;
use App\Period;

class PeriodsController extends Controller
{
  public function index()
  {
    return view('panel.admin.periods.index');
  }
  public function fetch(Request $request)
  {
    $period = Period::where('title', 'LIKE', '%' . $request->input('term', '') . '%')
      ->orderBy('created_at', 'desc')
      ->offset($request->input('page', 0) * 10)
      ->limit($request->input('limit', 10))
      ->get();
    return $period;
  }
  public function count(Request $request)
  {
    $count = Period::where('title', 'LIKE', '%' . $request->input('term', '') . '%')
      ->count();
    return $count;
  }
  public function store(Request $request)
  {
    $p = Period::all();
    if (sizeof($p) == 0) {
      $now = Time::jdate("Y-m", Carbon::now()->timestamp, '', 'Asia/Tehran', "en");
      $explode_now = explode("-", $now);
      $period = new Period;
      $period->title = $explode_now[0] . "-" . ($explode_now[1] + 1 - 1);
      $period->save();
      return redirect()->route('periods.index');
    } else {
      $last = $p[sizeof($p) - 1];
      $explode_last = explode("-", $last->title);
      $period = new Period;
      if($explode_last[1] == 12){
        $period->title = ($explode_last[0]+1) . "-" . "1";
      }else{
        $period->title = $explode_last[0] . "-" . ($explode_last[1] + 1);
      }
      $period->save();
      return redirect()->route('periods.index');
    }
  }
}
