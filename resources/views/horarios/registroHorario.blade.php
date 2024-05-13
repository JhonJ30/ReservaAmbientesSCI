@extends('layout/plantillaAdmin')

@php
    $ambientes = App\Models\Ambientes::all();
@endphp

@section('contenido')
<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<script src="{{ asset('js/RH.js') }}"></script>

<h1>REGISTRO HORARIOS</h1>
<form action="{{route('horarios.store')}}" method="POST">
@csrf
<div id="form-container">
    <div class="form-row">
        <div class="form-column">
            <label for="tipo-ambiente">Tipo de Ambiente:</label>
            <select name="tipoAmbiente" id="tipo-ambiente" onchange="toggleIntervalo()" required>
                 <option value="" disabled selected hidden>----</option>
                <option value="aula">Aula</option>
                <option value="laboratorio">Laboratorio</option>
                <option value="auditorio">Auditorio</option>
                <option value="taller">Taller</option>
            </select>
        </div>
        <div class="form-column">
            <label for="ambiente">Ambiente:</label>
            <select name="ambi" required>
                <option value="" disabled selected hidden>----</option>
                   @foreach($ambientes as $ambiente)
                <option value="{{ $ambiente->nroAmb }}">{{ $ambiente->nroAmb }}</option>
            @endforeach
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
            <label for="intervalo">Intervalo (si es necesario):</label>
            <input type="text" id="intervalo" onchange="calcularHoraFin()" placeholder="Ingrese el rango de intervalo" requiered>

        </div>
    <div class="button-container">
        <button type="button" class="cancelar-btn" onclick="cancelarRegistro()">Cancelar</button>
        <button class="registrar-btn" type="submit">Registrar</button>
    </div>
</form>
</div>

@endsection
