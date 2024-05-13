@extends(Auth::check() ?
(Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' :
(Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' :
'layout.plantillaInvitado'))
: 'layout.plantillaInvitado')

@section('contenido')
<!--hasta aqui menu-->
<link href="{{asset ('css/clienteReserva.css')}}" rel="stylesheet">
<script src="{{ asset('js/clienteReserva.js') }}"></script>
<div>
    <br>
    <div class="reserva-form">
        <h2>REGISTRAR RESERVA</h2>
        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="solicitante">Solicitante(*)</label>
                        <input type="text" id="solicitante" name="solicitante" value="{{ $nombreUsuario }} {{ $apellidoUsuario }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ambiente">Ambiente(*)</label>
                        <input type="text" id="ambiente" name="ambiente" value="{{ $nroAmbiente }}" readonly>
                        <input type="hidden" id="idAmbiente" name="idAmbiente" value="{{ $idAmbiente }}">
                    </div>
                    <div class="form-group">
                        <label for="hora_inicio">Hora de inicio(*)</label>
                        <input type="time" id="hora_inicio" name="hora_inicio" min="06:45" max="21:25" step="900" required>
                    </div>
                    <div class="form-group">
                        <label for="actividad">Actividad(*)</label>
                        <select id="actividad" name="actividad" onchange="toggleIntervalo()" required>
                            <option value="" disabled selected hidden>----</option>
                            <option value="Examen Normal">Examen Normal</option>
                            <option value="Examen de Mesa">Examen de Mesa</option>
                            <option value="Clase Normal">Clase Normal</option>
                            <option value="Clase Auxiliatura">Clase Auxiliatura</option>
                        </select>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="materia">Materia(*)</label>
                        <select id="materia" name="materia" onchange="toggleIntervalo()" required>
                            <option value="" disabled selected hidden>----</option>
                            @foreach($materias as $id => $materia)
                            <option value="{{ $id }}">{{ $materia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha(*)</label>
                        <!--se agrego @ para darle la funcion a los tiempos de las fechas-->
                        @php
                        $fecha_minima = date('Y-m-d', strtotime('+1 day'));
                        $mes_anio_actual = date('Y-m');
                        @endphp
                        <!--se aumento esto min="... y max=... para restriccion de fechas-->
                        <input type="date" id="fecha" name="fecha" value="{{ $fecha_minima }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="hora_fin">Hora de fin(*)</label>
                        <input type="time" id="hora_fin" name="hora_fin" min="06:45" max="21:45" step="900" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="estado">Estado(*)</label>
                        <input type="text" id="estado" name="estado"  required>
                    </div>-->
                </div>
            </div>
            <!-- esto es el código para mostrar el mensaje de error si existe -->
            @if(session('error'))
            <div style="color: {{ session('error_color', 'black') }}; font-weight: bold;"> <!--mensajes de error color rojo-->
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="botones">
                <button id="botonCancelar" class="botonCancelar" type="button" onclick="window.location.href='/verAmbientes'">Cancelar</button>
                <button class="botonRegistrar" type="submit">Registrar</button>
            </div>
        </form>
    </div>
</div>
@endsection