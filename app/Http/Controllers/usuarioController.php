<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bitacora;
use App\Models\UsuarioMateria;
use App\Models\Materias;
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
        $existingUsuario = User::where('codSis', $request->input('codSis'))
            ->orWhere(function ($query) use ($request) {
                $query->where('nombre', $request->input('nombre'))
                    ->where('apellido', $request->input('apellido'));
            })
            ->first();

        if ($existingUsuario) {
            return redirect()->route('usuarios.create')->with('success', '¡El usuario ya existe!');
        }

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
        $bitacora->id_Usuario = $idUsuario;
        $bitacora->evento = 'Create';
        $bitacora->tabla = 'usuario';
        $bitacora->id_Registro = $idUsu;
        $bitacora->dato_modificado = 'Nuevo Usuario: ' . $usuario->codSis . ', ' . $usuario->rol . ', ' . $usuario->nombre .
            ', ' . $usuario->correo;
        $bitacora->save();


        $errores = [];

        if ($request->get('rol') === 'Docente') {
            $asignaciones = $request->input('asignaciones');
            $asignacionesArray = json_decode($asignaciones[0], true);
    
            if (!empty($asignacionesArray)) {
                foreach ($asignacionesArray as $asignacion) {
                    $idMateria = $asignacion['materia'];
                    $grupo = $asignacion['grupo'];
    
                    $materia = Materias::find($idMateria);
                    if (!$materia) {
                        $errores[] = 'Materia no encontrada: ' . $idMateria;
                        continue;
                    }
    
                    $limiteGrupos = $materia->cantGrupos;
                    $countGruposExistentes = UsuarioMateria::where('idMateria', $idMateria)->count();
    
                    if ($countGruposExistentes >= $limiteGrupos) {
                        $errores[] = 'No se pueden agregar más grupos para la materia ' . $materia->nombre . '.';
                        continue;
                    }
    
                    $grupoExistente = UsuarioMateria::where('idMateria', $idMateria)->where('nGrupo', $grupo)->first();
                    if ($grupoExistente) {
                        $errores[] = 'El grupo ' . $grupo . ' ya existe para la materia ' . $materia->nombre . '.';
                        continue;
                    }
    
                    $usuarioMateria = new UsuarioMateria([
                        'idUsuario' => $usuario->id,
                        'idMateria' => $idMateria,
                        'nGrupo' => $grupo,
                    ]);
                    $usuarioMateria->save();
                }
            }
        }
    
        if (!empty($errores)) {
            $erroresMensaje = implode(' ', $errores);
            return redirect()->route('usuarios.create')->with('success', '¡El usuario ha sido registrado de manera correcta!
                                                                Sin embargo no se pudieron asignar algunas materias.');
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
        $bitacora->id_Usuario = $idUsuario;
        $bitacora->evento = 'Delete';
        $bitacora->tabla = 'usuario';
        $bitacora->id_Registro = $idUsu;
        $bitacora->dato_modificado = 'Usuario Eliminado: ' . $usuarios->codSis . ', ' . $usuarios->rol . ', ' . $usuarios->nombre .
            ', ' . $usuarios->correo;
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
        $datosOriginales = $usuario->toArray();

        if ($usuario->codSis != $request->input('codSis') || ($usuario->nombre != $request->input('nombre')
            && $usuario->apellido != $request->input('apellido'))) {
            $existingUsuario = User::where('codSis', $request->input('codSis'))
                ->orWhere(function ($query) use ($request) {
                    $query->where('nombre', $request->input('nombre'))
                        ->where('apellido', $request->input('apellido'));
                })
                ->first();
            if ($existingUsuario) {
                return redirect()->back()->withErrors(['error' => 'El usuario ya está registrado.']);
            }
        }

        $usuario->update([
            'codSis' => $request->get('codSis'),
            'rol' => $request->get('rol'),
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('correo'),
            'password' => bcrypt($request->get('contraseña')),
        ]);

        UsuarioMateria::where('idUsuario', $usuario->id)->delete();

        $errores = [];

        if ($request->get('rol') === 'Docente') {
            $asignaciones = $request->input('asignaciones');
            $asignacionesArray = json_decode($asignaciones[0], true);
    
            if (!empty($asignacionesArray)) {
                foreach ($asignacionesArray as $asignacion) {
                    $idMateria = $asignacion['materia'];
                    $grupo = $asignacion['grupo'];
    
                    $materia = Materias::find($idMateria);
                    if (!$materia) {
                        $errores[] = 'Materia no encontrada: ' . $idMateria;
                        continue;
                    }
    
                    $limiteGrupos = $materia->cantGrupos;
                    $countGruposExistentes = UsuarioMateria::where('idMateria', $idMateria)->count();
    
                    if ($countGruposExistentes >= $limiteGrupos) {
                        $errores[] = 'No se pueden agregar más grupos para la materia ' . $materia->nombre . '.';
                        continue;
                    }
    
                    $grupoExistente = UsuarioMateria::where('idMateria', $idMateria)->where('nGrupo', $grupo)->first();
                    if ($grupoExistente) {
                        $errores[] = 'El grupo ' . $grupo . ' ya existe para la materia ' . $materia->nombre . '.';
                        continue;
                    }
    
                    $usuarioMateria = new UsuarioMateria([
                        'idUsuario' => $usuario->id,
                        'idMateria' => $idMateria,
                        'nGrupo' => $grupo,
                    ]);
                    $usuarioMateria->save();
                }
            }
        }
    
        if (!empty($errores)) {
            $erroresMensaje = implode(' ', $errores);
            return redirect()->route('usuarios.create')->with('success', '¡Usuario actualizado correctamente!
                                                                Sin embargo no se pudieron asignar algunas materias.');
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

    public function home()
    {
        if (Auth::check()) {
            return view('usuarios/home');
        } else {
            return view('usuarios/homeInvitado');
        }
    }
}
