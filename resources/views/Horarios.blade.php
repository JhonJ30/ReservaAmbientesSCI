@extends('layout/plantilla')
@section('contenido')
<!--hasta aqui menu-->

<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<h1>REGISTRO HORARIOS</h1>
<form action="{{route('storeh')}}" method="POST">
@csrf
<div id="form-container">
    <div class="form-row">
        <div class="form-column">
            <label for="tipo-ambiente">Tipo de Ambiente:</label>
            <select name="tipoAmbiente" id="tipo-ambiente" onchange="toggleIntervalo()">
                <option value=""></option>
                <option value="aula">Aula</option>
                <option value="laboratorio">Laboratorio</option>
                <option value="auditorio">Auditorio</option>
                <option value="taller">Taller</option>
            </select>
        </div>
        <div class="form-column">
            <label for="ambiente">Ambiente:</label>
            <input type="text" name="ambiente" id="ambienteInput" placeholder="Ingrese el ambiente">
        </div>
    </div>
    <!-- nuevo comentario-->
    <div class="form-row">
        <div class="form-column">
            <label for="hora-inicio">Hora de Inicio:</label>
            <input name="horaInicio" type="time" id="hora-inicio"  onchange="calcularHoraFin()">
        </div>
        <div class="form-column">
            <label for="hora-fin">Hora de Fin:</label>
            <input name="horaFin" type="time" id="hora-fin">
        </div>
    </div>
        <div class="form-column"  id="intervalo-label">
            <label for="intervalo">Intervalo (si es necesario):</label>
            <input type="text" id="intervalo" onchange="calcularHoraFin()" placeholder="Ingrese el rango de intervalo">

        </div>
    <div class="button-container">
        <button class="cancelar-btn" onclick="cancelarRegistro()">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>
</form>
</div>

@endsection