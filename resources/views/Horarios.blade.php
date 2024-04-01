@extends('layout/plantilla')
@section('contenido')
<!--hasta aqui menu-->
<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<h1>Registro Horarios</h1>

<div id="form-container">
    <div class="form-row">
        <div class="form-column">
            <label for="tipo-ambiente">Tipo de Ambiente:</label>
            <select id="tipo-ambiente" onchange="toggleIntervalo()">
                <option value="aula">Aula</option>
                <option value="laboratorio">Laboratorio</option>
                <option value="auditorio">Auditorio</option>
                <option value="taller">Taller</option>
            </select>
        </div>
        <div class="form-column">
            <label for="ambiente">Ambiente:</label>
            <select id="ambiente"></select>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-column">
            <label for="hora-inicio">Hora de Inicio:</label>
            <input type="time" id="hora-inicio"  onchange="calcularHoraFin()">
        </div>
        <div class="form-column">
            <label for="hora-fin">Hora de Fin:</label>
            <input type="time" id="hora-fin">
        </div>
    </div>
        <div class="form-column"  id="intervalo-label">
            <label for="intervalo">Intervalo (si es necesario):</label>
            <input type="text" id="intervalo" onchange="calcularHoraFin()">
        </div>
    <div class="button-container">
        <button class="cancelar-btn" onclick="cancelarRegistro()">Cancelar</button>
        <button class="registrar-btn" onclick="registrarHorario()">Registrar</button>
    </div>
    <script>
    function redirigirRegistro() {
        window.location.href = 'RegistroHorario.php';
    }
</script>

</div>
<!--<script src="RH.js"></script>-->
@endsection