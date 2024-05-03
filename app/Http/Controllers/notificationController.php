<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notification;
use App\Models\Reservar;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class notificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }
    public function ObtenerNoti()
    {
       
        $usuario = Auth::id();

        // Realizar la consulta con JOIN
        $notificaciones = Notification::join('reserva', 'notificacion.codReser', '=', 'reserva.id')
                           ->where('reserva.codUser', $usuario)
                           ->where('notificacion.estado', 0)
                           ->select('notificacion.mensaje as mensaje', 'notificacion.id as idN','reserva.*')
                           ->get();
       
        return view('notificacion', compact('notificaciones'));
    }
    //contar las notificaciones
    public function contarNotificacionesRecientes()
    {
        $usuario = Auth::id(); 
        // Definir el rango de tiempo para las notificaciones recientes (por ejemplo, últimas 24 horas)
        $tiempo_reciente = Carbon::now()->subDay();

        // Contar las notificaciones enviadas recientemente al usuario
        $conteo = Notification::join('reserva', 'notificacion.codReser', '=', 'reserva.id')
                                ->where('reserva.codUser', $usuario)
                                ->where('notificacion.estado', 0) // Estado cero para notificaciones no leídas
                               ->where('notificacion.created_at', '>=', $tiempo_reciente)
                               ->count();

        return $conteo;
    }

 
    public function update(Request $request, $id)
    {
        $notificacion = Notification::findOrFail($id);
        $notificacion->estado = 1; // Cambia el estado de 0 a 1
        $notificacion->save();
        

        return redirect()->back()->with('notificaciones.ObtenerNoti', 'Registro eliminado correctamente');
    }








    //Reservas solicitud de acepta o rechazar

    public function Rechazar(Request $request)
    {
        //registrar en la tabla notificacion
        $notificacion = new Notification();
        $notificacion->codReser = $request->input('reserva_id');
        $notificacion->mensaje = 'Reserva rechazada';
        $notificacion->estado = 0; 
        $notificacion->save();
        //actulizar la tabla reserva
        $reserva = Reservar::findOrFail($request->input('reserva_id'));
        $reserva->estado ='Rechazado'; // Actualizar el estado a 1
        $reserva->save();

        return redirect()->route('reservas.verReserva');
    }

    public function store(Request $request)
    {
        $notificacion = new Notification();
        $notificacion->codReser = $request->input('reserva_id');
        $notificacion->mensaje = 'Reserva aceptada';
        $notificacion->estado = 0; 
        $notificacion->save();

         // Actualizar el estado de la reserva en la tabla de reservas
        $reserva = Reservar::findOrFail($request->input('reserva_id'));
        $reserva->estado = 'Aceptado'; // Actualizar el estado a 1
        $reserva->save();

        return redirect()->back()->with('success', 'Solicitud aceptada correctamente');

    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}