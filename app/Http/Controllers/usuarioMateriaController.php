<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materias;

class usuarioMateriaController extends Controller{
    public function index(){
        $usuario = User::find(1);
        $materia = Materias::find(2);
        return view("/nada", compact('usuario', 'materia'));
    }
}
