<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function terms(){

        return view('help.terms_and_conditions');
    }

    public function privacy(){

        return view('help.privicy_policy');
    }

    public function disclaimer(){

        return view('help.disclaimer');
    }
}
