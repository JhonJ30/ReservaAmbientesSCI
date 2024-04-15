<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteReservaController extends Controller
{
    public function mostrarFormularioReserva($ambiente_id)
    {
        return view('clienteReservar');
    }
}
