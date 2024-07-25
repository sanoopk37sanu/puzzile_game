<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Redirect;

class LoginController extends Controller
{


    function login()
    {

        return view('login');
    }

    // function dashbord()
    // {
    //     $users = User::find(1);
    //     return view('dashbord', compact('users'));
    // }

    function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    function do_login()
    {
        $input = ["email" => request('email'), "password" => request('password')];
        if (auth()->attempt($input, true)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }
}
