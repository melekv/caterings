<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends \App\Http\Controllers\Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|max:100',
            'password' => 'required|min:3|max:50'
        ]);

        // $2y$10$GiRHNufj4MLh5BsWAxvgOe95mqai/t4sXyh3/rU74D4k0RapogG4W

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}
