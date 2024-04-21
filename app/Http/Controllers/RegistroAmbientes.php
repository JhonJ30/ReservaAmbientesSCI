<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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
            return view('buscarAmbientes', ['ambientes' => $ambientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //el formulario donde nosotros aagregamos datos
        $ambientes=Ambientes::all();
        return view('listaAmb', compact('ambientes'));
        
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
        //$ambiente->equipamiento = $request->input('equipamiento');
        $ambiente->equipamiento = is_array($request->input('equipamiento')) ? implode(',', $request->input('equipamiento')) : $request->input('equipamiento');
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
  /*  public function destroy($id)
    {
        //elima un registro
        $registro = Ambientes::findOrFail($id);
        $registro->delete();

        return redirect()->back()->with('success', 'Registro eliminado correctamente');
    }*/
    public function destroy(Request $request)
    {
    $registro = Ambientes::findOrFail($request->registro_id);
    $registro->delete();

    return redirect()->back()->with('success', 'Registro eliminado correctamente');
    }
    //buscador de administrador

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        $ambientes = Ambientes::where('nroAmb', 'like', '%' . $searchTerm . '%')->get();
       return view('listaAmb',  compact('ambientes'));
        
    }

    //buscador de usuario
    public function buscar(Request $request){
        if (Auth::check()) {
            $usuario = Auth::user();
    
            // Imprimir el usuario como un arreglo
            dd($usuario);
        } else {
            // Realizar alguna acción si no hay usuario autenticado
        }

        $search = $request->input('search');
        $ambientes = Ambientes::query();

        if ($search) {
            $ambientes->where('nroAmb', 'like', '%' . $search . '%')
                      ->orWhere('ubicacion', 'like', '%' . $search . '%');
        }
        $resultados = $ambientes->get();

        if ($resultados->isEmpty()) {
            return view('buscarAmbientes');
        } else {
            return view('buscarAmbientes', ['ambientes' => $resultados]);
        }
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
        
        if ($resultados->isEmpty()) {
            return view('buscarAmbientes');
        } else {
            return view('buscarAmbientes', ['ambientes' => $resultados]);
        }
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
