<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class LanguageController extends Controller
{
    public function index($lang){
        if (isset($lang)) {
            session()->forget('localelang');
            $session = session()->put('localelang', $lang);
        }
        return redirect()->back();
    }
}
