<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller

{
  public function login(Request $request)
  {
    // return $request->all();
    if($request->password == "1234"){
      $user = User::firstOrFail();
      Auth::login($user);
      return redirect()->route('donees.index');
    }else{
      return redirect()->back();
    }
  }

  public function logout(){
    Auth::logout();
    return redirect()->route('login');
  }
}
