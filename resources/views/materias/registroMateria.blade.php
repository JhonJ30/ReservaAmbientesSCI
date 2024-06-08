@extends('layout/plantillaAdmin')
@section('contenido')

<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>REGISTRO DE MATERIA</h1>
<form id="csvForm" action="{{ route('materias.csv') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" id="csv_file">
    <button type="button" onclick="validarCSV()">Subir archivo CSV</button>
    <i class="fa fa-info-circle" id="infoIcon" onclick="mostrarFormatoCSV()" style="margin-left: 20px;"></i>
</form>

<div id="modalFormatoCSV" class="modal">
    <div class="modal-content" style="text-align: left;">
        <h2 style="text-align: center;">Formato de archivo CSV</h2>
        <p>Para registrar materias mediante un archivo CSV, se requiere que el archivo tenga el siguiente formato.</p>
        <ul>
            <li>C1: codMat</li>
            <li>C2: nivel</li>
            <li>C3: nombre</li>
            <li>C4: departamento</li>
            <li>C5: cantGrupos</li>
        </ul>
        <div class="button-container">
            <button class="btnAceptar" onclick="cerrarModal()">Aceptar</button>
        </div>
    </div>
</div>


<form id="registroForm" action="{{route('materias.store')}}" method="POST" onsubmit="return validarFormulario()">
    @csrf
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código de Materia: </label>
                <input name="codSis" type="number" required oninput="validarCodSis()">
                <p class="error" id="error-codSis" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="nivel">Nivel: </label>
                <select name="nivel" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                    <option value="I">I</option>
                    <option value="J">J</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre" type="text" style="width: 100%;" required oninput="validarNombre()">
                <p class="error" id="error-nombre" style="display: none; color: red;"></p>
            </div>

            <div class="form-column">
                <label for="cantGrupos">Grupos: </label>
                <input name="cantGrupos" type="number" required oninput="validarCantGrupos()">
                <p class="error" id="error-cantGrupos" style="display: none; color: red;"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column" id="column-unico">
                <label for="departamento">Departamento: </label>
                <select name="departamento" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="Biologia">Biologia</option>
                    <option value="Eléctrica">Eléctrica</option>
                    <option value="Física">Física</option>
                    <option value="Industrias">Industrias</option>
                    <option value="Informática">Informática</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Mecánica">Mecánica</option>
                    <option value="Química">Química</option>
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
    function cancelar() {
        var confirmar = confirm("Está seguro que quiere descartar el registro actual?");
        if (confirmar) {
            window.location.href = "/";
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
        var codigo = document.getElementsByName('codSis')[0].value;
        if (codigo === '') {
            ocultarError('codSis');
            return;
        }

        if (!/^\d{7}$/.test(codigo)) {
            mostrarError('codSis', "El código de materia debe contener 7 dígitos.");
        } else if (codigo.startsWith('0')) {
            mostrarError('codSis', "El código de materia no puede comenzar con cero.");
        } else {
            ocultarError('codSis');
        }
    }

    function validarNombre() {
        var nombre = document.getElementsByName('nombre')[0].value;
        if (nombre === '') {
            ocultarError('nombre');
            return;
        }

        if (nombre.length < 2 || nombre.length > 50) {
            mostrarError('nombre', "El nombre debe tener entre 2 y 50 caracteres.");
        } else {
            ocultarError('nombre');
        }
    }

    function validarCantGrupos() {
        var cantGrupos = document.getElementsByName('cantGrupos')[0].value;
        if (cantGrupos === '') {
            ocultarError('cantGrupos');
            return;
        }

        if (isNaN(cantGrupos) || cantGrupos < 1 || cantGrupos > 20) {
            mostrarError('cantGrupos', "La cantidad de grupos debe ser un número entre 1 y 20.");
        } else {
            ocultarError('cantGrupos');
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
        validarCantGrupos();

        var errores = document.querySelectorAll('.error:empty');
        return errores.length === 3; // Si no hay errores visibles, el formulario es válido
    }

    document.getElementById('registroForm').onsubmit = function() {
        return validarFormulario();
    };
</script>

@endsection
