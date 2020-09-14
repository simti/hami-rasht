<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drivers\Enviroment;

class SettingsController extends Controller
{
    public function transaction(Request $request){
        // return $request->all();
        Enviroment::set(['TRANSACTION' => $request->type==0?'last_record':'profile']);
        return redirect()->route('transactions.index');
    }
}
