@extends('layout/plantillaAdmin')
@section('contenido')

<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>REGISTRO DE MATERIA</h1>
<button class="csv">Subir desde .CSV</button>

<form action="{{route('materias.store')}}" method="POST" onsubmit="return error()">
    @csrf
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código de Materia: </label>
                <input name="codSis" , type="number" required>
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
                <input name="nombre" , type="text" , style="width: 100%;" required>
            </div>

            <div class="form-column">
                <label for="cantGrupos">Grupos: </label>
                <input name="cantGrupos" , type="number" required>
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
    function cancelar() {
        var confirmar = confirm("Esta seguro que quiere descartar el registro actual?");
        if (confirmar) {
            window.location.href = "/";
        }
    }
</script>

@endsection