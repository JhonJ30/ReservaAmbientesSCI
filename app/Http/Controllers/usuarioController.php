<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\User;

class UsuarioController extends Controller{
    public function create(){
        $usuarios=User::all();
        return view('listaUsuarios', compact('usuarios'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        $usuario = new User([
            'codSis' => $request->get('codSis'),
            'rol' => $request->get('rol'),
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'correo' => $request->get('correo'),
            'contraseña' => bcrypt($request->get('contraseña')),
        ]);
        $usuario->save();
        return redirect()->route('usuarios.create')->with('success', '¡El usuario ha sido registrado de manera correcta!');
    }

    public function search(Request $request){
        $searchTerm = $request->input('search');
        $usuarios = User::where('codSis', 'like', '%' . $searchTerm . '%')->get();
       return view('listaUsuarios',  compact('usuarios'));
    }
}