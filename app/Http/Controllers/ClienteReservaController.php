<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservar;
use App\Models\Materias; //para extraer materias
use Illuminate\Support\Facades\Auth;//extraer nombre de inicio de sesion

class ClienteReservaController extends Controller
{
    public function mostrarFormularioReserva($ambiente_id)
    {
        $nroAmbiente = $ambiente_id;//muestra el nro de aula
        $materias = Materias::pluck('nombre', 'id'); // obtiene todas las materias para visualizar
        $nombreUsuario = Auth::user()->nombre; // Obtener el nombre del usuario
        $apellidoUsuario = Auth::user()->apellido;
        return view('clienteReservar', compact('nroAmbiente','materias', 'nombreUsuario', 'apellidoUsuario'));
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
