<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use App\Models\Ambientes;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class horarioController extends Controller
{
    public function create()
    {
        $datos = Horarios::all();
        return view('horarios/listaHorarios', compact('datos'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $datos = Horarios::where('ambi', 'like', '%' . $searchTerm . '%')->get();
        return view('horarios/listaHorarios',  compact('datos'));
    }

    public function destroy(Request $request)
    {
        $registro = Horarios::findOrFail($request->registro_id);
        $registro->delete();

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idHorario = $registro->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario = $idUsuario;
        $bitacora->evento = 'Delete';
        $bitacora->tabla = 'horario';
        $bitacora->id_Registro = $idHorario;
        $bitacora->dato_modificado = 'Horario Eliminado: ' . $registro->ambi . ', ' . $registro->tipoAmbiente . ', ' . $registro->horaInicio .
            ', ' . $registro->horaFin;
        $bitacora->save();
        return redirect()->back()->with('success', 'Registro eliminado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //hecho por sara
    public function store(Request $request)
    {
        //sirve para guardar datos en la bd
        $Horario = new Horarios();
        $Horario->tipoAmbiente = $request->input('tipoAmbiente');
        $Horario->horaInicio = $request->input('horaInicio');
        $Horario->horaFin = $request->input('horaFin');
        $Horario->dias = $request->input('dias');

        // Guardar el nuevo ambiente en la base de datos
        $Horario->save();


        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idHorario = $Horario->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario = $idUsuario;
        $bitacora->evento = 'Create';
        $bitacora->tabla = 'horario';
        $bitacora->id_Registro = $idHorario;
        $bitacora->dato_modificado = 'Nuevo Horario: ' . $Horario->ambi . ', ' . $Horario->tipoAmbiente . ', ' . $Horario->horaInicio .
            ', ' . $Horario->horaFin;
        $bitacora->save();
        // Redirigir a una página de éxito o mostrar un mensaje de confirmación
        return redirect()->route('horarios.create')->with('success', '¡El horario ha sido registrado de manera correcta!');
    }



    public function getTiposAmbiente()
    {
        return Ambientes::all();
    }

    public function getNumerosAmbiente(Ambientes $tipoAmbiente)
    {
        $listaNros = Ambientes::all();

        return view('horarios/registroHorario', compact('listaNros'));
    }
    //cambios prueba AQUIIIIIIIIIIIIIIII
    public function edit($id)
    {
        $horario = Horarios::findOrFail($id);
        return view('horarios/editarHorarios', compact('horario'));
    } //CAMBIOSMODIFICAR
    public function update(Request $request, $id)
    {
        $horario = Horarios::find($id);
        $datosOriginales = $horario->toArray(); ////////añadido
        $horario->horaInicio = $request->horaInicio;
        $horario->horaFin = $request->horaFin;
        $horario->dias = $request->dias;
        $horario->intervalo = $request->intervalo;
        $horario->save();


        // Obtener todos los ambientes disponibles
        $ambientes = Ambientes::all(); //para q aparezca ambientes


        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idHorario = $horario->id;
        $idUsuario = Auth::id();


        $datosModificados = [];
        foreach ($request->except('_token', '_method') as $campo => $valor) {
            if (!array_key_exists($campo, $datosOriginales) || $datosOriginales[$campo] != $valor) {
                $datosModificados[$campo] = [
                    'original' => array_key_exists($campo, $datosOriginales) ? $datosOriginales[$campo] : null,
                    'nuevo' => $valor
                ];
            }
        }


        $datosModificadosJson = json_encode($datosModificados);

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario = $idUsuario;
        $bitacora->evento = 'Update';
        $bitacora->tabla = 'horario';
        $bitacora->id_Registro = $idHorario;
        $bitacora->dato_modificado = $datosModificadosJson;
        $bitacora->save();
        return redirect()->route('horarios.create')->with('success', '¡El horario ha sido modificado y guardado de manera correcta!');
    }
}
