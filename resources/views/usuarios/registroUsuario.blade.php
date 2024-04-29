@extends('layout/plantillaAdmin')

@php
    $materias = App\Models\Materias::all();
@endphp

@section('contenido')
<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>REGISTRO DE USUARIO</h1>
<button class="csv">Subir desde .CSV</button>

<form action="{{route('usuarios.store')}}" method="POST" onsubmit="return error()">
    @csrf
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código sis: </label>
                <input name="codSis" , type="number" required>
            </div>

            <div class="form-column">
                <label for="rol">Rol: </label>
                <select name="rol" id="rol" required onchange="mostrarMateriasDocente()">
                    <option value="" disabled selected hidden>----</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Docente">Docente</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre" , type="text" required>
            </div>

            <div class="form-column">
                <label for="apellido">Apellido: </label>
                <input name="apellido" , type="text" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="correo">Correo electrónico: </label>
                <input name="correo" , type="email" required>
            </div>

            <div class="form-column">
                <label for="contraseña">Contraseña: </label>
                <input name="contraseña" , type="password" required>
            </div>
        </div>

        <div class="materiasDocente" id="materiasDocente" style="display: none;">
            <div class="form-row">
                <div class="form-column">
                    <label for="materia">Materia: </label>
                    <select name="materia" id="materia">
                        <option value="" disabled selected hidden>----</option>
                        @foreach($materias as $materia)
                        <option value="{{ $materia->nombre}}" data-id="{{ $materia->id}}">{{ $materia->nombre }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-column">
                    <label for="grupo">Grupo: </label>
                    <input name="grupo" type="text" maxlength="2">
                </div>

                <button type="button" class="agregar-btn" onclick="agregarAsignacion()">Agregar</button>
            </div>

            <table id="asignacionesTabla">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="asignacionesBody">
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" name="asignaciones[]" value="">

    <div class="button-container">
        <button type="button" class="cancelar-btn" onclick="cancelar()">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>

</form>

<script src="{{ asset('js/registroUsuario.js') }}"></script>

@endsection