@extends('layout/plantillaAdmin')

@php
$materias = App\Models\Materias::all();
@endphp

@section('contenido')
<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>REGISTRO DE USUARIO</h1>
<form id="csvForm" action="{{ route('usuarios.csv') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" id="csv_file">
    <button type="button" onclick="validarCSV()">Subir archivo CSV</button>
    <i class="fa fa-info-circle" id="infoIcon" onclick="mostrarFormatoCSV()" style="margin-left: 20px;"></i>
</form>

<div id="modalFormatoCSV" class="modal">
    <div class="modal-content" style="text-align: left;">
        <h2 style="text-align: center;">Formato de archivo CSV</h2>
        <p>Para registrar usuarios mediante un archivo CSV, se requiere que el archivo tenga el siguiente formato.</p>
        <ul>
            <li>C1: codSis</li>
            <li>C2: rol</li>
            <li>C3: nombre</li>
            <li>C4: apellido</li>
            <li>C5: correo</li>
            <li>C6: contraseña</li>
        </ul>
        <div class="button-container">
            <button class="btnAceptar" onclick="cerrarModal()">Aceptar</button>
        </div>
    </div>
</div>

<form id="registroForm" action="{{route('usuarios.store')}}" method="POST">
    @csrf
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código sis: </label>
                <input name="codSis" type="number" required oninput="validarCodSis()">
                <p class="error" id="error-codSis" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="rol">Rol: </label>
                <select name="rol" id="rol" required">
                    <option value="" disabled selected hidden>----</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Docente">Docente</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre" type="text" required oninput="validarNombre()">
                <p class="error" id="error-nombre" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="apellido">Apellido: </label>
                <input name="apellido" type="text" required oninput="validarApellido()">
                <p class="error" id="error-apellido" style="display: none; color: red;"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="correo">Correo electrónico: </label>
                <input name="correo" type="email" required>
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

<script>
    function mostrarFormatoCSV() {
        var modal = document.getElementById("modalFormatoCSV");
        modal.style.display = "block";
    }

    function cerrarModal() {
        var modal = document.getElementById("modalFormatoCSV");
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        var modal = document.getElementById("modalFormatoCSV");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
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

    function validarCSV() {
        var inputFile = document.getElementById('csv_file');
        if (inputFile.files.length === 0) {
            alert("Debe seleccionar un archivo CSV.");
            return false;
        }
        document.getElementById('csvForm').submit();
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

    document.getElementById('registroForm').onsubmit = function() {
        return validarFormulario();
    };
</script>

<script src="{{ asset('js/registroUsuario.js') }}"></script>

@endsection