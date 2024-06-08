@extends('layout/plantillaAdmin')

@php
$materias = App\Models\Materias::all();
@endphp

@section('contenido')
<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>EDITAR USUARIO</h1>

<form action="{{ route('usuarios.update', $usuarios->id) }}" method="POST" id="editarUsuarioForm">
    @csrf
    @method('PUT')
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código sis: </label>
                <input name="codSis" type="number" required value="{{ $usuarios->codSis }}" oninput="validarCodSis()">
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
                <input name="nombre" type="text" required value="{{ $usuarios->nombre }}" oninput="validarNombre()">
                <p class="error" id="error-nombre" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="apellido">Apellido: </label>
                <input name="apellido" type="text" required value="{{ $usuarios->apellido }}" oninput="validarApellido()">
                <p class="error" id="error-apellido" style="display: none; color: red;"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="correo">Correo electrónico: </label>
                <input name="correo" type="email" required value="{{ $usuarios->email }}">
            </div>

            <div class="form-column">
                <label for="contraseña">Contraseña: </label>
                <input name="contraseña" type="password" required oninput="validarContraseña()">
                <p class="error" id="error-contraseña" style="display: none; color: red;"></p>
            </div>
        </div>

        <div id="checkboxMateriasDocente">
            <p for="mostrarMateriasDocente">Mostrar materias de docente</p>
            <input type="checkbox" id="mostrarMateriasDocente" style="width: 20px;" onchange="mostrarOcultarMateriasDocente()">
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

@if ($errors->any())
<div id="successModal" class="modal" style="display: block;">
    <div class="modal-content">
        <p><strong>{{ $errors->first() }}</strong></p>
        <div class="button-container">
            <button class="btnAceptar">Aceptar</button>
        </div>
    </div>
</div>
@endif

<script>
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btnAceptar')) {
            closeSuccessModal();
        }
    });

    function closeSuccessModal() {
        document.getElementById('successModal').style.display = 'none';
    }

    function mostrarOcultarMateriasDocente() {
        let checkbox = document.getElementById("mostrarMateriasDocente");
        let materiasDocente = document.getElementById("materiasDocente");

        if (checkbox.checked) {
            materiasDocente.style.display = "block";
        } else {
            materiasDocente.style.display = "none";
        }
    }

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

    function validarCodSis() {
        var codSis = document.getElementsByName('codSis')[0].value;
        if (codSis === "") {
            ocultarError('codSis');
        } else if (!(/^\d{9}$/.test(codSis))) {
            mostrarError('codSis', "El código sis debe contener 9 dígitos.");
        } else if (codSis.startsWith('0')) {
            mostrarError('codSis', "El código sis no puede comenzar con cero.");
        } else {
            ocultarError('codSis');
        }
    }

    function validarNombre() {
        var nombre = document.getElementsByName('nombre')[0].value;
        if (nombre === "") {
            ocultarError('nombre');
        } else if (!/^[A-Za-z\sÁÉÍÓÚáéíóúñÑ]+$/.test(nombre)) {
            mostrarError('nombre', "El nombre solo puede contener letras.");
        } else if (nombre.length < 2 || nombre.length > 20) {
            mostrarError('nombre', "El nombre debe tener entre 2 y 20 caracteres.");
        } else {
            ocultarError('nombre');
        }
    }

    function validarApellido() {
        var apellido = document.getElementsByName('apellido')[0].value;
        if (apellido === "") {
            ocultarError('apellido');
        } else if (!/^[A-Za-z\sÁÉÍÓÚáéíóúñÑ]+$/.test(apellido)) {
            mostrarError('apellido', "El apellido solo puede contener letras.");
        } else if (apellido.length < 2 || apellido.length > 20) {
            mostrarError('apellido', "El apellido debe tener entre 2 y 20 caracteres.");
        } else {
            ocultarError('apellido');
        }
    }

    function validarContraseña() {
        var contraseña = document.getElementsByName('contraseña')[0].value;
        if (contraseña === "") {
            ocultarError('contraseña');
        } else if (contraseña.length < 8) {
            mostrarError('contraseña', "La contraseña debe tener al menos 8 caracteres.");
        } else if (!/[a-z]/.test(contraseña)) {
            mostrarError('contraseña', "La contraseña debe contener al menos una letra minúscula.");
        } else if (!/[A-Z]/.test(contraseña)) {
            mostrarError('contraseña', "La contraseña debe contener al menos una letra mayúscula.");
        } else if (!/\d/.test(contraseña)) {
            mostrarError('contraseña', "La contraseña debe contener al menos un número.");
        } else if (!/\W/.test(contraseña)) {
            mostrarError('contraseña', "La contraseña debe contener al menos un carácter especial.");
        } else {
            ocultarError('contraseña');
        }
    }

    function validarFormulario() {
        validarCodSis();
        validarNombre();
        validarApellido();
        validarContraseña();

        var errores = document.querySelectorAll('.error');
        for (var i = 0; i < errores.length; i++) {
            if (errores[i].style.display === 'block') {
                return false;
            }
        }
        return true;
    }

    document.getElementById('editarUsuarioForm').onsubmit = function() {
        return validarFormulario();
    };
</script>

<script src="{{ asset('js/registroUsuario.js') }}"></script>

@endsection