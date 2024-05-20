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

    public function show($ambiente_id, $ambiente_nro)
    {
        $idAmbiente = $ambiente_id;
        $nroAmbiente = $ambiente_nro; //muestra el nro de aula
        $materias = Materias::pluck('nombre', 'id'); // obtiene todas las materias para visualizar
        $nombreUsuario = Auth::user()->nombre; // Obtener el nombre del usuario
        $apellidoUsuario = Auth::user()->apellido;
        return view('reservas/registroReserva', compact('idAmbiente', 'nroAmbiente', 'materias', 'nombreUsuario', 'apellidoUsuario'));
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

        // Verificar si ya existe una reserva para el mismo ambiente en la misma fecha y hora
        $reservaExistente = Reservar::where('codAmb', $request->get('idAmbiente'))
            ->where('fecha', $request->get('fecha'))
            ->where('horaInicio', $request->get('hora_inicio'))
            ->exists();

        if ($reservaExistente) {
            return redirect()->back()->with('error', 'Ya existe una reserva para este ambiente en la misma fecha y hora.')->with('error_color', 'red');
        }

        // CAMBIOS calcular la diferencia de tiempo entre la hora de inicio y la hora de fin
        $inicio = new \DateTime($request->get('hora_inicio'));
        $fin = new \DateTime($request->get('hora_fin'));
        $duracion = $inicio->diff($fin);

        // CAMBIOS verificar si la duración es exactamente de 90 minutos
        if ($duracion->format('%H:%I') !== '01:30') {
            return redirect()->back()->with('error', 'No aceptable el tiempo de reserva')->with('error_color', 'red');
        }

        // CAMBIOS verificar que la hora de inicio esté dentro de los horarios permitidos
        $horarios_permitidos = ['06:45', '08:15', '09:45', '11:15', '12:45', '14:15', '15:45', '17:15', '18:45', '20:15'];
        if (!in_array($request->get('hora_inicio'), $horarios_permitidos)) {
            return redirect()->back()->with('error', 'El horario no es valido')->with('error_color', 'red');
        }



        // para la creacion de uno nuevo en el formulario
        $reserva = new Reservar([
            'codUser' => Auth::id(), // obtiene el ID del usuario autenticado
            'codAmb' => $request->get('idAmbiente'),
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
    //editar reserva
    public function editar($id)
    {
        $nombreUsuario = Auth::user()->nombre;
        $apellidoUsuario = Auth::user()->apellido;
        $reserva = Reservar::findOrFail($id);
        $materias = Materias::pluck('nombre', 'id', 'idAmbiente');
        $nroAmbiente = $reserva->nroAmb;

        $actividad = $reserva->Actividad;
        $horaFin = $reserva->horaFin;
        $materia = $reserva->Materia;
        $idAmbiente = $reserva->codAmb;
        //retornar la vista de editar junto con los datos de la reserva y las materias :)
        return view('reservas.editarReserva', compact('reserva', 'nombreUsuario', 'apellidoUsuario', 'idAmbiente', 'nroAmbiente', 'materias', 'id', 'actividad', 'materia', 'horaFin'));
    }
    public function update(Request $request, $id)
    {
        $reserva = Reservar::findOrFail($id);
        // valida y actualiza los datos de la reserva según los datos enviados desde el formulario editar
        $reserva->horaInicio = $request->input('hora_inicio');
        $reserva->horaFin = $request->input('hora_fin');
        // Actualiza más campos según sea necesario
        $reserva->save();
        return redirect('/verAmbientes')->with('success', '¡Reserva actualizada exitosamente!');
    }



    public function informacion($id)
    {
        $reserva = Reservar::find($id);
        if (!$reserva) {
            abort(404, 'Reserva no encontrada');
        }
        return view('reservas/informacionReserva', compact('reserva'));
    }
}
