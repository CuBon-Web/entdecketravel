<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function index(Request $request){
        if (isset($request->code)) {
            Session::forget('locale');
            $session = Session::put('locale', $request->code);
        }
        return redirect()->back();
    }
}
