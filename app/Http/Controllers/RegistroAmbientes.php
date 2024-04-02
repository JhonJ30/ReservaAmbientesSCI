<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Ambientes;

class RegistroAmbientes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $ambientes = Ambientes::all();
            return view('verAmbientes', ['ambientes' => $ambientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //el formulario donde nosotros aagregamos datos
        $datos=Ambientes::all();
        return view('listaAmb', compact('datos'));
        
        //return view('pruebita');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //sirve para guardar datos en la bd
        $ambiente = new Ambientes();
        $ambiente->unidadAmb = $request->input('unidadAmb');
        $ambiente->tipoAmb = $request->input('tipoAmb');
        $ambiente->nroAmb = $request->input('nroAmb');
        $ambiente->ubicacion = $request->input('ubicacion');
        //$ambiente->equipamiento = $request->input('equipamiento');
        $ambiente->equipamiento = is_array($request->input('equipamiento')) ? implode(',', $request->input('equipamiento')) : $request->input('equipamiento');
        $ambiente->capacidad = $request->input('capacidad');
        $ambiente->descripcion = $request->input('descripcion');
        $ambiente->estado = $request->input('estado');
        

        // Guardar el nuevo ambiente en la base de datos
        $ambiente->save();

        // Redirigir a una página de éxito o mostrar un mensaje de confirmación
        //return redirect()->route('ambientes.create');


        // Redirigir a la página de creación de ambientes
        //return redirect()->route('ambientes.create');
        return redirect()->route('ambientes.create')->with('success', '¡Ambiente Registrado Correctamente!');
    }
    
    public function editar($id)
    {
    $ambiente = Ambientes::find($id); 

    if (!$ambiente) {
        return redirect()->route('listaA'); // Redirige a la lista si el ambiente no existe
    }

    return view('editarAmb', compact('ambiente')); // Cambia 'ruta.vista.editar' por la ruta real de tu vista de edición
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //servira para obtener un registro de nuestra tabala
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //este metodo nos sirve para traer los datos que se van a editar
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //elima un registro
        $registro = Ambientes::findOrFail($id);
        $registro->delete();

        return response()->json(['success' => true]);
    }

    public function buscar(Request $request){
        $search = $request->input('search');
        $ambientes = Ambientes::query();

        if ($search) {
            $ambientes->where('nroAmb', 'like', '%' . $search . '%')
                      ->orWhere('ubicacion', 'like', '%' . $search . '%');
        }
        $resultados = $ambientes->get();
        return view('verAmbientes', ['ambientes' => $resultados]);
    }

    public function buscarAvanzado(Request $request) {
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
        return view('verAmbientes', ['ambientes' => $resultados]);
    }
    
    public function showCalendario($id){
        $ambiente = Ambientes::find($id);
        if ($ambiente) {
            $nroAula = $ambiente->nroAmb;
        }else {
            $nroAula = 'Aula no encontrada';
        }
        return view('calendarioAmbiente', ['nroAula' => $nroAula]);
    }
}
