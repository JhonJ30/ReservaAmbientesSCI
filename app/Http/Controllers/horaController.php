<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use App\Models\Ambientes;
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
        $datos = Horarios::all();
        return view('ListaHorarios', compact('datos'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        $datos = Horarios::where('ambi', 'like', '%' . $searchTerm . '%')->get();
       return view('ListaHorarios',  compact('datos'));
        
    }

   /* public function destroy($id)
    {
        //elima un registro
        $registro = Horarios::findOrFail($id);
        $registro->delete();

        return response()->json(['success' => true]);
    }*/
    public function destroy(Request $request)
    {
    $registro = Horarios::findOrFail($request->registro_id);
    $registro->delete();

    return redirect()->back()->with('success', 'Registro eliminado correctamente');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //hecho por sara
    public function storeh(Request $request)
    {
        //sirve para guardar datos en la bd
        $Horario = new Horarios();
        $Horario->ambi = $request->input('ambi');
        $Horario->tipoAmbiente = $request->input('tipoAmbiente');
        $Horario->horaInicio = $request->input('horaInicio');
        $Horario->horaFin = $request->input('horaFin');

        // Guardar el nuevo ambiente en la base de datos
        $Horario->save();

        // Redirigir a una página de éxito o mostrar un mensaje de confirmación
        return redirect()->route('Horarios.create')->with('success', '¡El horario ha sido registrado de manera correcta!');
    }



    public function getTiposAmbiente()
    {
        return Ambientes::all();
    }

    public function getNumerosAmbiente(Ambientes $tipoAmbiente)
    {
        $listaNros = Ambientes::all();

        return view('Horarios', compact('listaNros'));
    }
    //cambios prueba AQUIIIIIIIIIIIIIIII
    public function edit($id)
    {
        $horario = Horarios::findOrFail($id);
        return view('layout.editarHorarios', compact('horario'));
    } //CAMBIOSMODIFICAR
    public function update(Request $request, $id)
    {
        $horario = Horarios::find($id);

        $horario->horaInicio = $request->horaInicio;
        $horario->horaFin = $request->horaFin;
        $horario->save();


        // Obtener todos los ambientes disponibles
        $ambientes = Ambientes::all(); //para q aparezca ambientes

        return redirect()->route('Horarios.create')->with('success', '¡El horario ha sido modificado y guardado de manera correcta!');
    }
}
