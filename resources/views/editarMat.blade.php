@extends('layout/plantilla')
@section('contenido')

<link href="{{asset ('css/usuario.css')}}" rel="stylesheet">

<h1>REGISTRO DE MATERIA</h1>
<button class="csv">Subir desde .CSV</button>

<form action="{{ route('materias.update', $materias->id) }}" method="POST" >
    @csrf
    @method('PUT')
    <div class="register">
        <div class="form-row">
            <div class="form-column">
                <label for="codSis">Código sis: </label>
                <input name="codSis", type="number" required value="{{ $materias->codSis }}">
            </div>

            <div class="form-column">
            <label for="nivel">Nivel: </label>
                <select name="nivel" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="A" {{ $materias->nivel == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $materias->nivel == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $materias->nivel == 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre", type="text", style="width: 100%;" required value="{{ $materias->nombre }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="departamento">Departamento: </label>
                <input name="departamento", type="text" required value="{{ $materias->departamento }}">
            </div>
            
            <div class="form-column">
                <label for="cantGrupos">Grupos: </label>
                <input name="cantGrupos", type="number" required value="{{ $materias->cantGrupos }}">
            </div>
        </div>
    </div>

    <div class="button-container">
        <button type="button" class="cancelar-btn" onclick="">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>
</form>

@endsection