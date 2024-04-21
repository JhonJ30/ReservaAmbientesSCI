@extends('layout/plantilla')
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
                <input name="codSis", type="number" required>
            </div>

            <div class="form-column">
            <label for="rol">Rol: </label>
                <select name="rol" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Docente">Docente</option>
                    <option value="Aulixiar">Auxiliar</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="nombre">Nombre: </label>
                <input name="nombre", type="text" required>
            </div>

            <div class="form-column">
                <label for="apellido">Apellido: </label>
                <input name="apellido", type="text" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="correo">Correo electrónico: </label>
                <input name="correo", type="email" required>
            </div>
            
            <div class="form-column">
                <label for="contraseña">Contraseña: </label>
                <input name="contraseña", type="password" required>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button type="button" class="cancelar-btn" onclick="cancelarRegistro()">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>
</form>

@endsection