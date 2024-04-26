<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservar;
use App\Models\Materias; //para extraer materias
use Illuminate\Support\Facades\Auth; //extraer nombre de inicio de sesion

class ClienteReservaController extends Controller
{
    public function mostrarFormularioReserva($ambiente_id)
    {
        $nroAmbiente = $ambiente_id; //muestra el nro de aula
        $materias = Materias::pluck('nombre', 'id'); // obtiene todas las materias para visualizar
        $nombreUsuario = Auth::user()->nombre; // Obtener el nombre del usuario
        $apellidoUsuario = Auth::user()->apellido;
        return view('clienteReservar', compact('nroAmbiente', 'materias', 'nombreUsuario', 'apellidoUsuario'));
    }

    public function create3()
    {
        $userId = Auth::id();

        $ambientes = Reservar::where('codUser', $userId)->get();

        return view('homeDocente', compact('ambientes'));
    }

    public function destroyR(Request $request)
    {
        $registro = Reservar::findOrFail($request->registro_id);
        $registro->delete();

        return redirect()->back()->with('success', 'Reserva eliminada');
    }
    //guardar registro :) :(
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'solicitante' => 'required',
            'ambiente' => 'required',
            'hora_inicio' => 'required',
            'actividad' => 'required',
            'materia' => 'required',
            'fecha' => 'required',
            'hora_fin' => 'required',
        ]);
        // para la creacion de uno nuevo en el formulario
        Reservar::create([
            'codUser' => Auth::id(), // obtiene el ID del usuario autenticado
            'codAmb' => $request->ambiente,
            'Materia' => $request->materia,
            'horaInicio' => $request->hora_inicio,
            'horaFin' => $request->hora_fin,
            'Actividad' => $request->actividad,
            'fecha' => $request->fecha,
        ]);

        // Redirigir a una página de éxito o donde desees
        return redirect('/client/verAmbientes')->with('success', 'Reserva realizada exitosamente');
    }
}
