<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Materias;
use App\Models\UsuarioMateria;
use App\Models\Reservar;
use App\Models\Bitacora;
use Carbon\Carbon;
class materiaController extends Controller
{
    public function create()
    {
        $materias = Materias::all();
        return view('materias/listaMaterias', compact('materias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $materia = new Materias([
            'codSis' => $request->get('codSis'),
            'nivel' => $request->get('nivel'),
            'nombre' => $request->get('nombre'),
            'departamento' => $request->get('departamento'),
            'cantGrupos' => $request->get('cantGrupos'),
        ]);
        $materia->save();

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idMateria = $materia->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario=$idUsuario;
        $bitacora->evento = 'Create';
        $bitacora->tabla = 'materia';
        $bitacora->id_Registro=$idMateria;
        $bitacora->dato_modificado = 'Nueva Materia: ' . $materia->codSis . ', ' . $materia->nivel . ', ' .$materia->nombre. 
        ', ' .$materia->cantGrupos;
        $bitacora->save();
        return redirect()->route('materias.create')->with('success', '¡La materia ha sido registrado de manera correcta!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $materias = Materias::where('codSis', 'like', '%' . $searchTerm . '%')->get();
        return view('materias/listaMaterias',  compact('materias'));
    }

    public function destroy(Request $request)
    {
        $materias = Materias::findOrFail($request->registro_id);
        UsuarioMateria::where('idMateria', $materias->id)->delete();
        Reservar::where('Materia', $materias->id)->delete();
        $materias->delete();

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idMateria = $materias->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario=$idUsuario;
        $bitacora->evento = 'Delete';
        $bitacora->tabla = 'materia';
        $bitacora->id_Registro=$idMateria;
        $bitacora->dato_modificado = 'Materia Eliminada: ' . $materias->codSis . ', ' . $materias->nivel . ', ' .$materias->nombre. 
        ', ' .$materias->cantGrupos;
        $bitacora->save();
        return redirect()->back()->with('success', '¡La materia ha sido eliminado correctamente!');
    }

    public function editar($id)
    {
        $materias = Materias::find($id);
        if (!$materias) {
            return redirect()->route('materias.create');
        }
        return view('materias.editarMaterias', compact('materias'));
    }

    public function update(Request $request, $id)
    {
        $materias = Materias::findOrFail($id);
        $datosOriginales = $materias->toArray();
        $materias->update($request->all());
        

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idMateria = $materias->id;
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
        $bitacora->tabla = 'materia';
        $bitacora->id_Registro = $idMateria;
        $bitacora->dato_modificado = $datosModificadosJson;
        $bitacora->save();
        return redirect()->route('materias.create')->with('success', '¡Materia actualizada Correctamente!');
    }
}
