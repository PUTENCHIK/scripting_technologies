<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signin_page()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {

    }

    public function signup_page()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {

    }
}
