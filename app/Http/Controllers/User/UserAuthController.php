<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    function signUpPage(Request $request){
        $title = '註冊';
        return view('auth.signUp',compact('title'));
    }
}
