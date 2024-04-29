<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Ambientes;

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
        $ambiente->update($request->all());

        return redirect()->route('ambientes.create')->with('success', '¡Ambiente actualizado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $registro = Ambientes::findOrFail($request->registro_id);
        $registro->delete();

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

    public function showCalendario($id)
    {
        $ambiente = Ambientes::find($id);
        $nroAula = $ambiente->nroAmb;
        return view('ambientes/calendarioAmbiente', compact('nroAula'));
    }
}
