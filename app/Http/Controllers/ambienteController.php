<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Ambientes;
use App\Models\Bitacora;
use Carbon\Carbon;

class ambienteController extends Controller
{
    public function index()
    {
        $ambientes = Ambientes::all();
        return view('ambientes/verAmbientes', compact('ambientes'));
    }

    public function create()
    {
        $ambientes = Ambientes::all();
        return view('ambientes/listaAmbientes', compact('ambientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar que no exista un ambiente con el mismo número y tipo
        $existingAmbiente = Ambientes::where('nroAmb', $request->input('nroAmb'))
            ->where('tipoAmb', $request->input('tipoAmb'))
            ->first();

        if ($existingAmbiente) {
            // Redirigir con un mensaje de error si el ambiente ya existe
            //return redirect()->back()->withInput()->withErrors('Ya existe un ambiente con el mismo número y tipo.');
            return redirect()->route('ambientes.create')->with('success', '¡El ambiente ya existe!');
        }

        //sirve para guardar datos en la bd
        $ambiente = new Ambientes();
        $ambiente->unidadAmb = $request->input('unidadAmb');
        $ambiente->tipoAmb = $request->input('tipoAmb');
        $ambiente->nroAmb = $request->input('nroAmb');
        $ambiente->ubicacion = $request->input('ubicacion');
        $ambiente->equipamiento = is_array($request->input('equipamiento')) ? implode(', ', $request->input('equipamiento')) : $request->input('equipamiento');
        $ambiente->capacidad = $request->input('capacidad');
        $ambiente->descripcion = $request->input('descripcion');
        $ambiente->estado = $request->input('estado');


        // Guardar el nuevo ambiente en la base de datos
        $ambiente->save();

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idAmbiente = $ambiente->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario = $idUsuario;
        $bitacora->evento = 'Create';
        $bitacora->tabla = 'ambiente';
        $bitacora->id_Registro = $idAmbiente;
        $bitacora->dato_modificado = 'Nuevo ambiente: ' . $ambiente->nroAmb . ', ' . $ambiente->tipoAmb . ', ' . $ambiente->equipamiento .
            ', ' . $ambiente->capacidad;
        $bitacora->save();
        return redirect()->route('ambientes.create')->with('success', '¡Ambiente Registrado Correctamente!');
    }

    public function editar($id)
    {
        $ambiente = Ambientes::find($id);
        if (!$ambiente) {
            return redirect()->route('ambientes.create');
        }
        return view('ambientes/editarAmbientes', compact('ambiente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ambiente = Ambientes::findOrFail($id);
        $datosOriginales = $ambiente->toArray();

        $ambiente->update($request->all());

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idAmbiente = $ambiente->id;
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
        $bitacora->tabla = 'ambiente';
        $bitacora->id_Registro = $idAmbiente;
        $bitacora->dato_modificado = $datosModificadosJson;
        $bitacora->save();
        return redirect()->route('ambientes.create')->with('success', '¡Ambiente actualizado Correctamente!');
    }



    public function destroy(Request $request)
    {
        $registro = Ambientes::findOrFail($request->registro_id);
        $registro->delete();


        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idAmbiente = $registro->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario = $idUsuario;
        $bitacora->evento = 'Delete';
        $bitacora->tabla = 'ambiente';
        $bitacora->id_Registro = $idAmbiente;
        $bitacora->dato_modificado = 'Ambiente Eliminado: ' . $registro->nroAmb . ', ' . $registro->tipoAmb . ', ' . $registro->equipamiento .
            ', ' . $registro->capacidad;
        $bitacora->save();
        return redirect()->back()->with('success', 'Registro eliminado correctamente');
    }

    public function buscar(Request $request)
    {
        $search = $request->input('search');

        //buscador de administrador
        if (Auth::user()->rol === 'Administrador') {
            $ambientes = Ambientes::where('nroAmb', 'like', '%' . $search . '%')->get();
            return view('ambientes/listaAmbientes',  compact('ambientes'));
        }

        //buscador de otros usuarios
        else {
            if (empty($search)) {
                return redirect()->route('ambientes.index');
            } else {
                $ambientes = Ambientes::where('nroAmb', 'like', '%' . $search . '%')
                    ->orWhere('ubicacion', 'like', '%' . $search . '%')->get();
                return view('ambientes/verAmbientes', compact('ambientes'));
            }
        }
    }

    public function buscarAvanzado(Request $request)
    {
        $recursos = $request->input('recursos');
        $minValue = $request->input('minValue');
        $maxValue = $request->input('maxValue');
        $ambientes = Ambientes::query();

        if ($recursos) {
            foreach ($recursos as $recurso) {
                $ambientes->where('equipamiento', 'like', '%' . $recurso . '%');
            }
        }
        if ($minValue && $maxValue) {
            $ambientes->whereBetween('capacidad', [$minValue, $maxValue]);
        }
        $resultados = $ambientes->get();

        if (empty($recursos) && empty($minValue) && empty($maxValue)) {
            return redirect()->route('ambientes.index');
        } else {
            return view('ambientes/verAmbientes', ['ambientes' => $resultados]);
        }
    }

    public function showCalendario($id, $fecha = null)
    {
        $idAmbiente = $id;
        $ambiente = Ambientes::find($id);
        $nroAula = $ambiente->nroAmb;

        if ($fecha === null) {
            $inicioSemana = Carbon::now()->startOfWeek();
            $finSemana = Carbon::now()->endOfWeek();
        } else {
            $fecha = Carbon::createFromFormat('Y-m-d', $fecha)->startOfWeek();
            $inicioSemana = $fecha->copy();
            $finSemana = $fecha->endOfWeek();
        }
        return view('ambientes/calendarioAmbiente', compact('nroAula', 'idAmbiente', 'inicioSemana', 'finSemana'));
    }
}
