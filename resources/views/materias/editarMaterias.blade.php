@extends('layout/plantillaAdmin')
@section('contenido')

<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>EDITAR MATERIA</h1>
<!-- <button class="csv">Subir desde .CSV</button> -->

<form action="{{ route('materias.update', $materias->id) }}" method="POST" >
    @csrf
    @method('PUT')
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código de Materia: </label>
                <input name="codSis", type="number" required value="{{ $materias->codSis }}">
                <p class="error" id="error-codSis" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="nivel">Nivel: </label>
                <select name="nivel" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="A" {{ $materias->nivel == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $materias->nivel == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $materias->nivel == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ $materias->nivel == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ $materias->nivel == 'E' ? 'selected' : '' }}>E</option>
                    <option value="F" {{ $materias->nivel == 'F' ? 'selected' : '' }}>F</option>
                    <option value="G" {{ $materias->nivel == 'G' ? 'selected' : '' }}>G</option>
                    <option value="H" {{ $materias->nivel == 'H' ? 'selected' : '' }}>H</option>
                    <option value="I" {{ $materias->nivel == 'I' ? 'selected' : '' }}>I</option>
                    <option value="J" {{ $materias->nivel == 'J' ? 'selected' : '' }}>J</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre", type="text", style="width: 100%;" required value="{{ $materias->nombre }}">
                <p class="error" id="error-nombre" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="cantGrupos">Grupos: </label>
                <input name="cantGrupos", type="number" required value="{{ $materias->cantGrupos }}">
                <p class="error" id="error-cantGrupos" style="display: none; color: red;"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column" id="column-unico">
                <label for="departamento">Departamento: </label>
                <select name="departamento" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="Biologia" {{ $materias->departamento == 'Biologia' ? 'selected' : '' }}>Biologia</option>
                    <option value="Eléctrica" {{ $materias->departamento == 'Eléctrica' ? 'selected' : '' }}>Eléctrica</option>
                    <option value="Física" {{ $materias->departamento == 'Física' ? 'selected' : '' }}>Física</option>
                    <option value="Industrias" {{ $materias->departamento == 'Industrias' ? 'selected' : '' }}>Industrias</option>
                    <option value="Informática" {{ $materias->departamento == 'Informática' ? 'selected' : '' }}>Informática</option>
                    <option value="Matemáticas" {{ $materias->departamento == 'Matemáticas' ? 'selected' : '' }}>Matemáticas</option>
                    <option value="Mecánica" {{ $materias->departamento == 'Mecánica' ? 'selected' : '' }}>Mecánica</option>
                    <option value="Química" {{ $materias->departamento == 'Química' ? 'selected' : '' }}>Química</option>
                </select>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button type="button" class="cancelar-btn" onclick="cancelar()">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>
</form>

<script>
    function cancelar() {
        var confirmar = confirm("Esta seguro que quiere descartar el registro actual?");
        if (confirmar) {
            window.location.href = "/";
        }
    }
    // Función para mostrar mensajes de error
    function mostrarError(inputId, mensaje) {
        var elementoError = document.getElementById('error-' + inputId);
        elementoError.textContent = mensaje;
        elementoError.style.display = 'block'; // Mostrar el mensaje
    }

    // Función para ocultar mensajes de error
    function ocultarError(inputId) {
        var elementoError = document.getElementById('error-' + inputId);
        elementoError.textContent = '';
        elementoError.style.display = 'none'; // Ocultar el mensaje
    }

    // Función de validación
    function validarFormulario() {
        var codigo = document.getElementsByName('codSis')[0].value;
        var nombre = document.getElementsByName('nombre')[0].value;
        var cantGrupos = document.getElementsByName('cantGrupos')[0].value;
        // Obtener los valores de los otros campos

        var error = "";

        if (!(/^\d{7}$/.test(codigo))) {
            error += "El código de materia debe contener 7 dígitos.\n";
            mostrarError('codSis', "El código de materia debe contener 7 dígitos.");
        } else if (codigo.startsWith('0')) {
            error += "El código de materia no puede comenzar con cero.\n";
            mostrarError('codSis', "El código de materia no puede comenzar con cero.");
        } else {
            ocultarError('codSis');
        }

        // Nombre
        if (nombre.length < 2 || nombre.length > 50) {
            error += "El nombre debe tener entre 2 y 50 caracteres.\n";
            mostrarError('nombre', "El nombre debe tener entre 2 y 50 caracteres.");
        } else {
            ocultarError('nombre');
        }

        // Cantidad de grupos
        if (isNaN(cantGrupos) || cantGrupos < 1 || cantGrupos > 20) {
            error += "La cantidad de grupos debe ser un número entre 1 y 20.\n";
            mostrarError('cantGrupos', "La cantidad de grupos debe ser un número entre 1 y 20.");
        } else {
            ocultarError('cantGrupos');
        }

        // Si hay errores, detener el envío del formulario
        if (error !== "") {
            return false;
        }

        return true; // Permitir el envío del formulario si no hay errores
    }

    // Asignar la función de validación al evento onsubmit del formulario
    document.getElementsByTagName('form')[0].onsubmit = function() {
        return validarFormulario();
    };
</script>

@endsection