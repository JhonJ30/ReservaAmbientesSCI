@extends('layout/plantillaAdmin')

@php
$materias = App\Models\Materias::all();
@endphp

@section('contenido')
<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>EDITAR USUARIO</h1>
<!-- <button class="csv">Subir desde .CSV</button> -->

<form action="{{ route('usuarios.update', $usuarios->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código sis: </label>
                <input name="codSis" , type="number" required value="{{ $usuarios->codSis }}">
                <p class="error" id="error-codSis" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="rol">Rol: </label>
                <select name="rol" id="rol" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="Administrador" {{ $usuarios->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="Docente" {{ $usuarios->rol == 'Docente' ? 'selected' : '' }}>Docente</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre" , type="text" required value="{{ $usuarios->nombre }}">
                <p class="error" id="error-nombre" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="apellido">Apellido: </label>
                <input name="apellido" , type="text" required value="{{ $usuarios->apellido }}">
                <p class="error" id="error-apellido" style="display: none; color: red;"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="correo">Correo electrónico: </label>
                <input name="correo" , type="email" required value="{{ $usuarios->email }}">
            </div>

            <div class="form-column">
                <label for="contraseña">Contraseña: </label>
                <input name="contraseña" type="password" required>
                <p class="error" id="error-contraseña" style="display: none; color: red;"></p>
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
                    @php
                    $asignacionesUsuario = App\Models\UsuarioMateria::where('idUsuario', $usuarios->id)->get();
                    $asignacionesPendientes = [];
                    @endphp

                    @foreach($asignacionesUsuario as $asignacion)
                    @php
                    $materia = App\Models\Materias::find($asignacion->idMateria);
                    $asignacionesPendientes[] = [
                    'materia' => strval($materia->id),
                    'grupo' => $asignacion->nGrupo
                    ];
                    @endphp
                    <tr>
                        <td data-id="{{ $materia->id }}">{{ $materia->nombre }}</td>
                        <td>{{ $asignacion->nGrupo }}</td>
                        <td>
                            <button type="button" style="background-color: #393e41;" onclick="editarAsignacion(this)">Editar</button>
                            <button type="button" style="background-color: #0D7360;" onclick="eliminarAsignacion(this)">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach

                    @php
                    $asignacionesPendientesJson = json_encode($asignacionesPendientes);
                    @endphp

                    <input type="hidden" name="asignaciones[]" value="{{ $asignacionesPendientesJson }}">
                </tbody>
            </table>

        </div>
    </div>

    <input type="hidden" name="asignaciones[]" value="">

    <div class="button-container">
        <button type="button" class="cancelar-btn" onclick="cancelar()">Cancelar</button>
        <button class="registrar-btn" type="submit">Editar</button>
    </div>

</form>

<script>
    function mostrarMateriasDocente() {
        var rol = document.getElementById("rol").value;
        var materiasDocenteDiv = document.getElementById("materiasDocente");

        if (rol === "Docente") {
            materiasDocenteDiv.style.display = "block";
        } else {
            materiasDocenteDiv.style.display = "none";
        }
    }

    window.onload = function() {
        mostrarMateriasDocente();
    };

    function mostrarError(inputId, mensaje) {
        var elementoError = document.getElementById('error-' + inputId);
        elementoError.textContent = mensaje;
        elementoError.style.display = 'block';
    }

    function ocultarError(inputId) {
        var elementoError = document.getElementById('error-' + inputId);
        elementoError.textContent = '';
        elementoError.style.display = 'none';
    }

    function validarFormulario() {
        var codSis = document.getElementsByName('codSis')[0].value;
        var nombre = document.getElementsByName('nombre')[0].value;
        var apellido = document.getElementsByName('apellido')[0].value;
        var correo = document.getElementsByName('correo')[0].value;
        var contraseña = document.getElementsByName('contraseña')[0].value;

        var error = "";

        if (!(/^\d{9}$/.test(codSis))) {
            error += "El código sis debe contener 9 dígitos.\n";
            mostrarError('codSis', "El código sis debe contener 9 dígitos.");
        } else if (codSis.startsWith('0')) {
            error += "El código sis no puede comenzar con cero.\n";
            mostrarError('codSis', "El código sis no puede comenzar con cero.");
        } else {
            ocultarError('codSis');
        }

        if (!/^[A-Za-z\sÁÉÍÓÚáéíóúñÑ]+$/.test(nombre)) {
            error += "El nombre solo puede contener letras.\n";
            mostrarError('nombre', "El nombre solo puede contener letras.");
        } else if (nombre.length < 2 || nombre.length > 20) {
            error += "El nombre debe tener entre 2 y 20 caracteres.\n";
            mostrarError('nombre', "El nombre debe tener entre 2 y 20 caracteres.");
        } else {
            ocultarError('nombre');
        }

        if (!/^[A-Za-z\sÁÉÍÓÚáéíóúñÑ]+$/.test(apellido)) {
            error += "El apellido solo puede contener letras.\n";
            mostrarError('apellido', "El apellido solo puede contener letras.");
        } else if (apellido.length < 2 || apellido.length > 20) {
            error += "El apellido debe tener entre 2 y 20 caracteres.\n";
            mostrarError('apellido', "El apellido debe tener entre 2 y 20 caracteres.");
        } else {
            ocultarError('apellido');
        }

        if (contraseña.length < 8) {
            error += "La contraseña debe tener al menos 8 caracteres.\n";
            mostrarError('contraseña', "La contraseña debe tener al menos 8 caracteres.");
        } else if (!/[a-z]/.test(contraseña)) {
            error += "La contraseña debe contener al menos una letra minúscula.\n";
            mostrarError('contraseña', "La contraseña debe contener al menos una letra minúscula.");
        } else if (!/[A-Z]/.test(contraseña)) {
            error += "La contraseña debe contener al menos una letra mayúscula.\n";
            mostrarError('contraseña', "La contraseña debe contener al menos una letra mayúscula.");
        } else if (!/\d/.test(contraseña)) {
            error += "La contraseña debe contener al menos un número.\n";
            mostrarError('contraseña', "La contraseña debe contener al menos un número.");
        } else if (!/\W/.test(contraseña)) {
            error += "La contraseña debe contener al menos un carácter especial.\n";
            mostrarError('contraseña', "La contraseña debe contener al menos un carácter especial.");
        } else {
            ocultarError('contraseña');
        }

        if (error !== "") {
            return false;
        }

        return true;
    }

    document.getElementsByTagName('form')[0].onsubmit = function() {
        return validarFormulario();
    };
</script>

<script src="{{ asset('js/registroUsuario.js') }}"></script>

@endsection