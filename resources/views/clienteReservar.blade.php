@extends('layout/plantillaUser')
@section('contenido')
<!--hasta aqui menu-->
<link href="{{asset ('css/clienteReserva.css')}}" rel="stylesheet">
<script src="{{ asset('js/clienteReserva.js') }}"></script>
<div>
    <br>
    <div class="reserva-form">
        <h2>REGISTRAR RESERVA</h2>
        <form action="{{ route('reserva.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="solicitante">Solicitante(*)</label>
                        <input type="text" id="solicitante" name="solicitante"  required>
                    </div>
                    <div class="form-group">
                        <label for="ambiente">Ambiente(*)</label>
                        <select id="ambiente" name="ambiente" onchange="toggleIntervalo()" required>
                            <option value="" disabled selected hidden>----</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hora_inicio">Hora de inicio(*)</label>
                        <input type="time" id="hora_inicio" name="hora_inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="actividad">Actividad(*)</label>
                        <input type="text" id="actividad" name="actividad" required>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="materia">Materia(*)</label>
                        <select id="ambiente" name="ambiente" onchange="toggleIntervalo()" required>
                            <option value="" disabled selected hidden>----</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha(*)</label>
                        <input type="date" id="fecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="hora_fin">Hora de fin(*)</label>
                        <input type="time" id="hora_fin" name="hora_fin" required>
                    </div>
                </div>
            </div>
            <div class="botones">
            <button id="botonCancelar" class="botonCancelar" type="button" onclick="window.location.href='/client'">Cancelar</button>
            <button class="botonRegistrar" type="submit">Registrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
