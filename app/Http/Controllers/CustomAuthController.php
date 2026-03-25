<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view('auth.custom-login');
    }

    public function forgotPassword()
    {
        return view('auth.custom-forgot-password');
    }
}
