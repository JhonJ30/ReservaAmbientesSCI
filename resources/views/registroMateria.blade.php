@extends('layout/plantilla')
@section('contenido')

<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>REGISTRO DE MATERIA</h1>
<button class="csv">Subir desde .CSV</button>

<form action="{{route('materias.store')}}" method="POST" onsubmit="return error()">
    @csrf
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código sis: </label>
                <input name="codSis", type="number" required>
            </div>

            <div class="form-column">
            <label for="nivel">Nivel: </label>
                <select name="nivel" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre", type="text", style="width: 100%;" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="departamento">Departamento: </label>
                <input name="departamento", type="text" required>
            </div>
            
            <div class="form-column">
                <label for="cantGrupos">Grupos: </label>
                <input name="cantGrupos", type="number" required>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button type="button" class="cancelar-btn" onclick="">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>
</form>

@endsection