<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class loginController extends Controller{
    public function login(){
        $credentials = request()->only('rol', 'email', 'password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if ($user->rol === 'Administrador') {
                return redirect('/admin');
            }elseif ($user->rol === 'Docente') {
                return redirect('/docente');
            } elseif ($user->rol === 'Auxiliar') {
                return view('/aux');
            }else{
            }
        }else{
            return $credentials;
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
