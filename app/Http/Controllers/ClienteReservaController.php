<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservar;
use Illuminate\Support\Facades\Auth;

class ClienteReservaController extends Controller
{
    public function mostrarFormularioReserva($ambiente_id)
    {
        return view('clienteReservar');
    }

    public function create3()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
    
        // Obtener solo las reservas del usuario autenticado
        $ambientes = Reservar::where('codUser', $userId)->get();
    
        // Pasar las reservas a la vista
        return view('homeDocente', compact('ambientes'));
    }

    public function destroyR(Request $request)
    {
    $registro = Reservar::findOrFail($request->registro_id);
    $registro->delete();

    return redirect()->back()->with('success', 'Reserva eliminada');
    }
}
