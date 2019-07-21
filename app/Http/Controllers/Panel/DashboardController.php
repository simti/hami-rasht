<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
  public function dashboard(Request $request)
  {
    return 'dashboard';
  }

  public function deactivated_users()
  {
    return view('panel.admin.deactivated');
  }
}
