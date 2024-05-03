<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservar;
use App\Models\Materias; //para extraer materias
use Illuminate\Support\Facades\Auth; //extraer nombre de inicio de sesion

class reservaController extends Controller
{
    public function create()
    {
        $reservas = Reservar::all();
        return view('reservas/listaReservas', compact('reservas'));
    }

    public function show($ambiente_id)
    {
        $nroAmbiente = $ambiente_id; //muestra el nro de aula
        $materias = Materias::pluck('nombre', 'id'); // obtiene todas las materias para visualizar
        $nombreUsuario = Auth::user()->nombre; // Obtener el nombre del usuario
        $apellidoUsuario = Auth::user()->apellido;
        return view('reservas/registroReserva', compact('nroAmbiente', 'materias', 'nombreUsuario', 'apellidoUsuario'));
    }

    public function destroy(Request $request)
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
        
        // para verificar si ya existe una reserva para el mismo ambiente en la misma fecha y hora
        $reservaExistente = Reservar::where('codAmb', $request->ambiente)
            ->where('fecha', $request->fecha)
            ->where('horaInicio', $request->hora_inicio)
            ->exists();

        if ($reservaExistente) {
            return redirect()->back()->with('error', 'Ya existe una reserva para este ambiente en la misma hora.');
        }

        // para la creacion de uno nuevo en el formulario
        $reserva = new Reservar([
            'codUser' => Auth::id(), // obtiene el ID del usuario autenticado
            'codAmb' => $request->get('ambiente'),
            'Materia' => $request->get('materia'),
            'horaInicio' => $request->get('hora_inicio'),
            'horaFin' => $request->get('hora_fin'),
            'Actividad' => $request->get('actividad'),
            'fecha' => $request->get('fecha'),
            'estado' => "Proceso",
        ]);
        $reserva->save();

        // Redirigir a una página de éxito o donde desees
        return redirect('/verAmbientes')->with('success', 'Reserva realizada exitosamente');
    }

    public function verReserva()
    {
        $reservas = Reservar::join('users', 'reserva.codUser', '=', 'users.id')
            ->where('reserva.estado', "Proceso")
            ->select('users.nombre as nombre', 'users.apellido as apellido', 'users.email as correo', 'reserva.*')
            ->get();
        return view('reservas/listaReservas', compact('reservas'));
    }
}
