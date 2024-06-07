@extends('layout/plantillaAdmin')

@section('contenido')
<!-- Agrega aquí los estilos del formulario -->
<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<h1>EDITAR HORARIO</h1>
<form action="{{ route('horarios.update', ['id' => $horario->id]) }}" method="POST" id="formulario">
    @csrf
    @method('PUT')
    <div id="form-container">
        <div class="form-row">
            <div class="form-column">
                <label for="tipo-ambiente">Tipo de Ambiente:</label>
                <select name="tipoAmbiente" id="tipo-ambiente" onchange="toggleIntervalo()" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="aula" {{ $horario->tipoAmbiente == 'aula' ? 'selected' : '' }}>Aula</option>
                    <option value="laboratorio" {{ $horario->tipoAmbiente == 'laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                    <option value="auditorio" {{ $horario->tipoAmbiente == 'auditorio' ? 'selected' : '' }}>Auditorio</option>
                    <option value="taller" {{ $horario->tipoAmbiente == 'taller' ? 'selected' : '' }}>Taller</option>
                </select>                
            </div>
            <div class="form-column">
                <label for="dias">Días:</label>
                <select name="dias" id="dias" required>
                    <option value="" disabled selected hidden>----</option>
                    <option value="lunes" {{ $horario->dias == 'lunes' ? 'selected' : '' }}>Lunes</option>
                    <option value="martes" {{ $horario->dias == 'martes' ? 'selected' : '' }}>Martes</option>
                    <option value="miercoles" {{ $horario->dias == 'miercoles' ? 'selected' : '' }}>Miércoles</option>
                    <option value="jueves" {{ $horario->dias == 'jueves' ? 'selected' : '' }}>Jueves</option>
                    <option value="viernes" {{ $horario->dias == 'viernes' ? 'selected' : '' }}>Viernes</option>
                    <option value="sabado" {{ $horario->dias == 'sabado' ? 'selected' : '' }}>Sábado</option>
                </select>
            </div>
        </div>

        <!-- nuevo comentario-->
        <div class="form-row">
            <div class="form-column">
                <label for="hora-inicio">Hora de Inicio:</label>
                <input name="horaInicio" type="time" id="hora-inicio" onchange="calcularHoraFin()" required min="06:45" max="21:45" value="{{ $horario->horaInicio }}">
            </div>
            <div class="form-column">
                <label for="hora-fin">Hora de Fin:</label>
                <input name="horaFin" type="time" id="hora-fin" required min="06:45" max="21:45" value="{{ $horario->horaFin }}">
            </div>
        </div>
        <div class="form-column" id="intervalo-label" @if($horario->tipoAmbiente === 'auditorio' || $horario->tipoAmbiente === 'taller') style="display: none;" @endif>
            <label for="intervalo">Intervalo (si es necesario):</label>
            <input type="text" id="intervalo" placeholder="Ingrese el rango de intervalo" value="{{ $horario->intervalo }}">
        </div>
        <div class="button-container">
            <a href="/listaHorarios">
                <button class="cancelar-btn" type="button" onclick=" ">Cancelar</button>
            </a>
            <button class="Editar-btn" type="submit">Editar</button>
        </div>
    </div>
</form>
@endsection

<script>
    function toggleIntervalo() {
        var tipoAmbiente = document.getElementById('tipo-ambiente').value;
        var intervaloInput = document.getElementById('intervalo');
        var intervaloLabel = document.getElementById('intervalo-label');
        if (tipoAmbiente === 'auditorio' || tipoAmbiente === 'taller') {
            intervaloInput.style.display = 'none';
            intervaloLabel.style.display = 'none';
        } else {
            intervaloInput.style.display = 'block';
            intervaloLabel.style.display = 'block';
        }
    }
    function calcularHoraFin() {
        var tipoAmbiente = document.getElementById('tipo-ambiente').value;
        var horaInicio = document.getElementById('hora-inicio').value;
        var intervalo = parseInt(document.getElementById('intervalo').value, 10);

        if (tipoAmbiente === 'aula' || tipoAmbiente === 'laboratorio') {
            if (horaInicio && !isNaN(intervalo) && intervalo > 0) {
                var [horaInicioHoras, horaInicioMinutos] = horaInicio.split(':').map(Number);
                var horaInicioTotalMinutos = horaInicioHoras * 60 + horaInicioMinutos;
                var horaFinTotalMinutos = horaInicioTotalMinutos + intervalo;
                var horaFinHoras = Math.floor(horaFinTotalMinutos / 60);
                var horaFinMinutos = horaFinTotalMinutos % 60;
                var horaFin = horaFinHoras.toString().padStart(2, '0') + ':' + horaFinMinutos.toString().padStart(2, '0');
                document.getElementById('hora-fin').value = horaFin;
            }
        }
    }

    document.getElementById('hora-inicio').onchange = calcularHoraFin;
    document.getElementById('intervalo').onchange = calcularHoraFin;
    function cancelarRegistro() {
        document.getElementById("formulario").reset();
    }
</script>
