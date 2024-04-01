<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use Illuminate\Http\Request;

class horaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeh(Request $request)
    {
        //sirve para guardar datos en la bd
        $Horario = new Horarios();
        $Horario->ambi = $request->input('ambi');
        $Horario->tipoHora = $request->input('tipoHora');
        $Horario->horaInicio = $request->input('horaInicio');
        $Horario->horaFin = $request->input('horaFin');

        // Guardar el nuevo ambiente en la base de datos
        $Horario->save();

        // Redirigir a una página de éxito o mostrar un mensaje de confirmación
        return redirect()->route('Horarios.create')->with('success', '¡El horario ha sido registrado de manera correcta :)!');
    }
    /*public function editar($id)
    {
    $ambiente = Ambientes::find($id); 

    if (!$ambiente) {
        return redirect()->route('listaA'); // Redirige a la lista si el ambiente no existe
    }

    return view('editarAmb', compact('ambiente')); // Cambia 'ruta.vista.editar' por la ruta real de tu vista de edición
    }*/
}