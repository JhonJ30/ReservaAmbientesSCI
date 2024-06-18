<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
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

    public function destroy($id)
    {
        $registro = Reservar::findOrFail($id);
        $registro->delete();

        return redirect()->back()->with('success', 'Reserva eliminada');
    }
    //guardar registro :) :(
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'solicitante' => 'required', // Aquí cambiaste validateEquired por required
            'ambiente' => 'required', // Aquí cambiaste validateEquired por required
            'hora_inicio' => 'required', // Aquí cambiaste validateEquired por required
            'actividad' => 'required', // Aquí cambiaste validateEquired por required
            'materia' => 'required', // Aquí cambiaste validateEquired por required
            'fecha' => 'required', // Aquí cambiaste validateEquired por required
            'hora_fin' => 'required', // Aquí cambiaste validateEquired por required
        ]);
        // Verificar si ya existe una reserva aceptada para el mismo ambiente en la misma fecha y hora
        $reservaExistente = Reservar::where('codAmb', $request->get('idAmbiente'))
            ->where('fecha', $request->get('fecha'))
            ->where(function ($query) use ($request) {
                $query->whereBetween('horaInicio', [$request->get('hora_inicio'), $request->get('hora_fin')])
                    ->orWhereBetween('horaFin', [$request->get('hora_inicio'), $request->get('hora_fin')])
                    ->orWhereRaw('? BETWEEN horaInicio AND horaFin', [$request->get('hora_inicio')])
                    ->orWhereRaw('? BETWEEN horaInicio AND horaFin', [$request->get('hora_fin')]);
            })
            ->where('estado', 'Aceptado')
            ->exists();

        if ($reservaExistente) {
            return redirect()->back()->with('error', 'Ya existe una reserva aceptada para este ambiente en la misma fecha y hora.')->with('error_color', 'ed');
        }

        // Verificar si el usuario ya tiene una reserva pendiente o aceptada para el mismo ambiente, fecha y hora
        $userHasReservation = Reservar::where('codUser', Auth::id())
            ->where('codAmb', $request->get('idAmbiente'))
            ->where('fecha', $request->get('fecha'))
            ->where(function ($query) use ($request) {
                $query->whereBetween('horaInicio', [$request->get('hora_inicio'), $request->get('hora_fin')])
                    ->orWhereBetween('horaFin', [$request->get('hora_inicio'), $request->get('hora_fin')])
                    ->orWhereRaw('? BETWEEN horaInicio AND horaFin', [$request->get('hora_inicio')])
                    ->orWhereRaw('? BETWEEN horaInicio AND horaFin', [$request->get('hora_fin')]);
            })
            ->whereIn('estado', ['Proceso', 'Aceptado'])
            ->exists();

        if ($userHasReservation) {
            return redirect()->back()->with('error', 'Ya tienes una reserva pendiente o aceptada para este ambiente en la misma fecha y hora.')
                ->with('error_color', 'red');
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

        if (Auth::check()) {
            if (Auth::user()->rol === 'Administrador') {
                return redirect('/listaAmbientes')->with('success', 'Reserva realizada exitosamente');
            } else {
                return redirect('/verAmbientes')->with('success', 'Reserva realizada exitosamente');
            }
        } else {
            return redirect('/verAmbientes')->with('success', 'Reserva realizada exitosamente');
        }
    }
    // nueva funcion 
    public function Rechazar(Request $request)
    {
        $reserva = Reservar::findOrFail($request->reserva_id);
        $reserva->estado = 'Rechazado';
        $reserva->save();

        return redirect()->back()->with('success', 'Reserva rechazada exitosamente.');
    }
    public function verReserva()
    {
        $reservas = Reservar::join('users', 'reserva.codUser', '=', 'users.id')
            ->where('reserva.estado', "Proceso")
            ->select('users.nombre as nombre', 'users.apellido as apellido', 'users.email as correo', 'reserva.*')
            ->get();
        return view('reservas/listaReservas', compact('reservas'));
    }
    // Función para aceptar la reserva
    public function aceptarReserva($id)
    {
        $reserva = Reservar::findOrFail($id);

        // Verificar si ya existe una reserva aceptada para el mismo ambiente en la misma fecha y hora
        $reservaExistente = Reservar::where('codAmb', $reserva->codAmb)
            ->where('fecha', $reserva->fecha)
            ->where(function ($query) use ($reserva) {
                $query->whereBetween('horaInicio', [$reserva->horaInicio, $reserva->horaFin])
                    ->orWhereBetween('horaFin', [$reserva->horaInicio, $reserva->horaFin])
                    ->orWhereRaw('? BETWEEN horaInicio AND horaFin', [$reserva->horaInicio])
                    ->orWhereRaw('? BETWEEN horaInicio AND horaFin', [$reserva->horaFin]);
            })
            ->where('estado', 'Aceptado')
            ->exists();

        if ($reservaExistente) {
            return redirect()->back()->with('error', 'Ya existe una reserva aceptada para este ambiente en la misma fecha y hora.')->with('error_color', 'red');
        }

        $reserva->estado = 'Aceptado';
        $reserva->save();

        return redirect()->back()->with('success', 'Reserva aceptada exitosamente.');
    }
    public function aceptar($id)
    {
        // Encuentra la reserva por ID
        $reserva = Reservar::findOrFail($id);

        // Cambia el estado de la reserva a 'Aceptado'
        $reserva->estado = 'Aceptado';
        $reserva->save();

        // Elimina otras reservas para el mismo ambiente y fecha
        Reservar::where('codAmb', $reserva->codAmb)
            ->where('fecha', $reserva->fecha)
            ->where('id', '!=', $id) // Excluye la reserva actual
            ->delete();

        return redirect()->back()->with('success', 'Reserva aceptada y otras reservas eliminadas.');
    }
    //editar reserva
    public function editar($id)
    {
        $nombreUsuario = Auth::user()->nombre;
        $apellidoUsuario = Auth::user()->apellido;
        $reserva = Reservar::findOrFail($id);
        $materias = Materias::pluck('nombre', 'id', 'idAmbiente');
        $nombre = Ambientes::where('id', $reserva->codAmb)->first();
        $nroAmbiente = $nombre->nroAmb;

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
        // Actualiza más campos según sea necesario :)
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
