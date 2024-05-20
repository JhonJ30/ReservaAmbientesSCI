<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\aviso;
use Illuminate\Support\Facades\Storage;

class avisoController extends Controller
{
    //
   /*public function verAvisoHome()
    {
       
        $avisos = aviso::where('estado', "Habilitado")->get();
        return view('usuarios/home',compact('avisos'));
    }*/
     public function descargarArchivo($archivo)
    {
       
       // Encuentra la ubicación del archivo en el sistema de archivos
        $rutaArchivo = 'archivos/' . $archivo;

        // Verifica si el archivo existe en el sistema de archivos
        if (Storage::exists($rutaArchivo)) {
            // Descarga el archivo
            return Storage::download($rutaArchivo);
        }

        // Manejo de error si el archivo no se encuentra o no se puede descargar
        abort(404);
    }
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
    }else {
        // Si no se carga ningún archivo, establece un valor predeterminado para el campo 'archivo'
        $avisos->archivo = 'sin_archivo'; // Puedes cambiar 'sin_archivo' por cualquier valor que desees
    }

        $avisos->save();
        return redirect()->route('avisos.verAvisos')->with('success', '¡Aviso Registrado Correctamente!');
    }
    public function eliminar(Request $request)
    {
        $registro = aviso::findOrFail($request->registro_id);
        $registro->delete();
        return redirect()->back()->with('success', 'Registro eliminado correctamente');
    }

    public function editar($id)
{
    $avisos = aviso::findOrFail($id);
    return view('avisos/editaviso', compact('avisos'));
}

public function update(Request $request, $id)
{
    $avisos = aviso::findOrFail($id);
    $avisos->titulo = $request->input('titulo');
    $avisos->descripcion = $request->input('descripcion');
    $avisos->fecInicio = $request->input('fecha_inicio');
    $avisos->fecFin = $request->input('fecha_fin');
    
    // Verifica si se ha subido un nuevo archivo
    if ($request->hasFile('archivo')) {
        // Obtiene el archivo
        $archivo = $request->file('archivo');
        
        // Guarda el archivo en el sistema de archivos
        $nombreArchivo = $archivo->getClientOriginalName(); // Obtén el nombre original del archivo
        $archivo->storeAs('archivos', $nombreArchivo); // Guarda el archivo en la carpeta 'archivos'

        // Actualiza la ruta del archivo en la base de datos
        $avisos->archivo = $nombreArchivo;
    }
    
    $avisos->save();
    return redirect()->route('avisos.verAvisos')->with('success', '¡Aviso Actualizado Correctamente!');
}
}
