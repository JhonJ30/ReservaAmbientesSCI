@extends('layout/plantilla')
@section('contenido')
<!--hasta aqui menu-->

<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<h1>REGISTRO DE HORARIOS</h1>
<form action="{{route('storeh')}}" method="POST" id="formulario">
@csrf
<div id="form-container">
    <div class="form-row">
        <div class="form-column">
            <label for="tipo-ambiente">Tipo de Ambiente:</label>
            <select name="tipoAmbiente" id="tipo-ambiente" onchange="toggleIntervalo()">
                <option value="" disabled selected hidden class="opcion-deshabilitada">----</option>
                <option value="aula">Aula</option>
                <option value="laboratorio">Laboratorio</option>
                <option value="auditorio">Auditorio</option>
                <option value="taller">Taller</option>
            </select>
        </div>
        <div class="form-column">
            <label for="ambiente">Ambiente:</label>
            <select name="ambi" required>
                <!--poner aqui metodo para recuperar ambientes seleccionados-->
                <option value="" disabled selected hidden class="opcion-deshabilitada">----</option>
                <option value="690B">690B</option>
                <option value="Lab1">Lab1</option>
            </select>
        </div>
    </div>
    <!-- nuevo comentario-->
    <div class="form-row">
        <div class="form-column">
            <label for="hora-inicio">Hora de Inicio:</label>
            <input name="horaInicio" type="time" id="hora-inicio"  onchange="calcularHoraFin()" required>
        </div>
        <div class="form-column">
            <label for="hora-fin">Hora de Fin:</label>
            <input name="horaFin" type="time" id="hora-fin" required>
        </div>
    </div>
        <div class="form-column"  id="intervalo-label">
            <label for="intervalo">Intervalo:</label>
            <input type="text" id="intervalo" onchange="calcularHoraFin()" placeholder="Ingrese el rango de intervalo" required>
        </div>
    <div class="button-container">
        <button class="cancelar-btn" type="button" onclick="cancelarRegistro()">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>
</form>
</div>

@endsection