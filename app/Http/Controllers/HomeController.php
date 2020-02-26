<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indexPage(){
        $title = 'Home';
        return view('Home',compact('title'));
    }
}
