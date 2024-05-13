<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\aviso;

class avisoController extends Controller
{
    //
    public function verAvisos()
    {
       $avisos = aviso::all();
      // $avisos = aviso::where('estado', "Habilitado")->get();
        return view('avisos/viewlistAviso',compact('avisos'));
    }
    public function add(Request $request){
        $avisos = new aviso();
        $avisos->titulo = $request->input('titulo');
        $avisos->descripcion = $request->input('descripcion');
        $avisos->fecInicio = $request->input('fecha_inicio');
        $avisos->fecFin = $request->input('fecha_fin');
        $avisos->estado='Habilitado';
        // Verifica si se ha subido un archivo
    if ($request->hasFile('archivo')) {
        // Obtiene el archivo
        $archivo = $request->file('archivo');
        
        // Guarda el archivo en el sistema de archivos
        $nombreArchivo = $archivo->getClientOriginalName(); // Obtén el nombre original del archivo
        $archivo->storeAs('archivos', $nombreArchivo); // Guarda el archivo en la carpeta 'archivos'

        // Guarda la ruta del archivo en la base de datos
        $avisos->archivo = $nombreArchivo;
    }

        $avisos->save();
        return redirect()->route('avisos.verAvisos')->with('success', '¡Aviso Registrado Correctamente!');
    }
}
