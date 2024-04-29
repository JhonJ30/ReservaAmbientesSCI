<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('rol', 'email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect('/');
        } else {
            $errorMessage = 'Credenciales no válidas';
            return redirect()->back()->with('errorMessage', $errorMessage)->withInput($request->except('password'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}