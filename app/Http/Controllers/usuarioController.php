<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsuarioMateria;

class UsuarioController extends Controller
{
    public function create()
    {
        $usuarios = User::all();
        return view('usuarios/listaUsuarios', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User([
            'codSis' => $request->get('codSis'),
            'rol' => $request->get('rol'),
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('correo'),
            'password' => bcrypt($request->get('contraseña')),
        ]);
        $usuario->save();

        if ($request->get('rol') === 'Docente') {
            $asignaciones = $request->input('asignaciones');
            $asignacionesArray = json_decode($asignaciones[0], true);
            if (!empty($asignacionesArray)) {
                foreach ($asignacionesArray as $asignacion) {
                    $usuarioMateria = new UsuarioMateria([
                        'idUsuario' => $usuario->id,
                        'idMateria' => $asignacion['materia'],
                        'nGrupo' => $asignacion['grupo'],
                    ]);
                    $usuarioMateria->save();
                }
            }
        }
        return redirect()->route('usuarios.create')->with('success', '¡El usuario ha sido registrado de manera correcta!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $usuarios = User::where('codSis', 'like', '%' . $searchTerm . '%')->get();
        return view('usuarios/listaUsuarios',  compact('usuarios'));
    }

    public function destroy(Request $request)
    {
        $usuarios = User::findOrFail($request->registro_id);
        $usuarios->delete();

        return redirect()->back()->with('success', '¡El usuario ha sido eliminado correctamente!');
    }

    public function editar($id)
    {
        $usuarios = User::find($id);
        if (!$usuarios) {
            return redirect()->route('usuarios.create');
        }
        return view('usuarios/editarUsuarios', compact('usuarios'));
    }

    public function update(Request $request, $id)
    {
        $usuarios = User::findOrFail($id);
        $usuarios->update($request->all());
        
        return redirect()->route('usuarios.create')->with('success', '¡Usuario actualizado Correctamente!');
    }
}
