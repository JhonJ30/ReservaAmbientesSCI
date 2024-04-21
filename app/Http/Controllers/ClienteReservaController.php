<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservar;

class ClienteReservaController extends Controller
{
    public function mostrarFormularioReserva($ambiente_id)
    {
        return view('clienteReservar');
    }

    public function create3()
    {
        $ambientes = Reservar::all();
        return view('homeDocente', compact('ambientes'));
    }

    public function destroyR(Request $request)
    {
    $registro = Reservar::findOrFail($request->registro_id);
    $registro->delete();

    return redirect()->back()->with('success', 'Reserva eliminada');
    }
}
