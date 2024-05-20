<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bitacora;
use App\Models\UsuarioMateria;
use App\Models\Reservar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        
        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idUsu = $usuario->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario=$idUsuario;
        $bitacora->evento = 'Create';
        $bitacora->tabla = 'usuario';
        $bitacora->id_Registro=$idUsu;
        $bitacora->dato_modificado = 'Nuevo Usuario: ' . $usuario->codSis . ', ' . $usuario->rol . ', ' .$usuario->nombre. 
        ', ' .$usuario->correo;
        $bitacora->save();

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
        UsuarioMateria::where('idUsuario', $usuarios->id)->delete();
        Reservar::where('codUser', $usuarios->id)->delete();
        $usuarios->delete();
        

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idUsu = $usuarios->id;
        $idUsuario = Auth::id();

        $bitacora->fecha = $fechaYHoraActual->toDateString();
        $bitacora->hora = $fechaYHoraActual->toTimeString();
        $bitacora->id_Usuario=$idUsuario;
        $bitacora->evento = 'Delete';
        $bitacora->tabla = 'usuario';
        $bitacora->id_Registro=$idUsu;
        $bitacora->dato_modificado = 'Usuario Eliminado: ' . $usuarios->codSis . ', ' . $usuarios->rol . ', ' .$usuarios->nombre. 
        ', ' .$usuarios->correo;
        $bitacora->save();
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
        $usuario = User::findOrFail($id);
        $datosOriginales = $usuario->toArray();////añadido
        $usuario->update([
            'codSis' => $request->get('codSis'),
            'rol' => $request->get('rol'),
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('correo'),
            'password' => bcrypt($request->get('contraseña')),
        ]);
        
        UsuarioMateria::where('idUsuario', $usuario->id)->delete();
        
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

        $bitacora = new Bitacora();
        $fechaYHoraActual = Carbon::now();
        $idUsu = $usuario->id;
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
        $bitacora->tabla = 'usuario';
        $bitacora->id_Registro = $idUsu;
        $bitacora->dato_modificado = $datosModificadosJson;
        $bitacora->save();
        return redirect()->route('usuarios.create')->with('success', '¡Usuario actualizado correctamente!');
    }

    public function home(){
        if(Auth::check()){
            return view('usuarios/home');
        }else{
            return view('usuarios/homeInvitado');
        }
    }
}