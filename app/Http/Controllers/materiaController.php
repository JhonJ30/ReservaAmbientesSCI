<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;

class materiaController extends Controller{
    public function create(){
        $materias=Materias::all();
        return view('listaMaterias', compact('materias'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        $materia = new Materias([
            'codSis' => $request->get('codSis'),
            'nivel' => $request->get('nivel'),
            'nombre' => $request->get('nombre'),
            'departamento' => $request->get('departamento'),
            'cantGrupos' => $request->get('cantGrupos'),
        ]);
        $materia->save();
        return redirect()->route('materias.create')->with('success', '¡La materia ha sido registrado de manera correcta!');
    }

    public function search(Request $request){
        $searchTerm = $request->input('search');
        $materias = Materias::where('codSis', 'like', '%' . $searchTerm . '%')->get();
        return view('listaMaterias',  compact('materias'));
    }
    public function destroy(Request $request)
    {
        $materias = Materias::findOrFail($request->registro_id);
        $materias->delete();
    
        return redirect()->back()->with('success', '¡La materia ha sido eliminado correctamente!');
    }
    public function editar($id)
    {
    $materias = Materias::find($id); 

    if (!$materias) {
        return redirect()->route('listaM'); // Redirige a la lista si el ambiente no existe
    }

    return view('editarMat', compact('materias')); // Cambia 'ruta.vista.editar' por la ruta real de tu vista de edición
    }

    public function update(Request $request, $id)
    {
        $materias = Materias::findOrFail($id);
        $materias->update($request->all());

    return redirect()->route('materias.create')->with('success', '¡Materia actualizada Correctamente!');

    }
}
