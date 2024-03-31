<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambientes;

class RegistroAmbientes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pagina de inicio
        
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
        $ambiente->ublicacion = $request->input('ubicacion');
        $ambiente->equipamiento = $request->input('equipamiento');
        $ambiente->capacidad = $request->input('capacidad');
        $ambiente->descripcion = $request->input('descripcion');
        $ambiente->estado = $request->input('estado');
        

        // Guardar el nuevo ambiente en la base de datos
        $ambiente->save();

        // Redirigir a una página de éxito o mostrar un mensaje de confirmación
        return redirect()->route('pruebita')->with('success', 'El ambiente ha sido registrado correctamente.');
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
        //actualiza los datos
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
    }
}
