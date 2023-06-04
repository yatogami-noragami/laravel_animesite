<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Register Page

    public function register()
    {
        return view('register');
    }

    //login Page

    public function login()
    {
        return view('login');
    }

    //The Wall Between Admin and User

    public function wall()
    {
        if (Auth::user()->role == 'user') {
            return redirect()->route('user#home');
        } else {
            return redirect()->route('admin#home');
        }
    }
}
