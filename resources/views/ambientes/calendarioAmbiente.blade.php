@extends(Auth::check() && Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' : 'layout.plantillaInvitado')

@section('contenido')
<link href="{{ asset('css/calendario.css') }}" rel="stylesheet">

<h1 class="aviso">{{ $nroAula }}: CALENDARIO</h1>

<div class="navegacionCalendario">
    <span>{{ $inicioSemana->format('d/m/Y') }} - {{ $finSemana->format('d/m/Y') }}</span>
    <div class="enlaces">
        <a class="exit" href="{{ route('ambientes.index') }}">
            <i class="fas fa-right-from-bracket"></i>
        </a>

        <a class="actual" href="{{ route('ambientes.calendario', ['id' => $idAmbiente]) }}">Semana Actual</a>
        <a id="anterior" href="{{ route('ambientes.calendario', ['id' => $idAmbiente, 'fecha' => $inicioSemana->copy()->subWeek()->toDateString()]) }}">
            <i class="fas fa-circle-left"></i>
        </a>
        <a href="{{ route('ambientes.calendario', ['id' => $idAmbiente, 'fecha' => $inicioSemana->copy()->addWeek()->toDateString()]) }}">
            <i class="fas fa-circle-right"></i>
        </a>
    </div>
</div>

<div class="calendarioContainer">
    <table>
        <tr>
            <th></th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
        </tr>

        @php
        $horarios = [
        '6:45', '8:15', '9:45', '11:15', '12:45', '14:15', '15:45', '17:15', '18:45', '20:15'
        ];

        $reservas = \DB::table('reserva')
        ->where('codAmb', $idAmbiente)
        ->whereBetween('fecha', [$inicioSemana->toDateString(), $finSemana->toDateString()])
        ->where('estado', 'Aceptado')
        ->get();
        @endphp

        @foreach($horarios as $hora)
        <tr>
            <td class="horas">{{ $hora }}</td>
            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia)
            <td class="reserva-celda" 
                @php
                    $fechaDia = $inicioSemana->copy()->addDays($loop->index)->toDateString();
                    $reserva = $reservas->first(function ($reserva) use ($fechaDia, $hora) {
                        $horaTemporal = strtotime($hora);
                        $horaInicioTemporal = strtotime($reserva->horaInicio);
                        return $reserva->fecha === $fechaDia && $horaInicioTemporal === $horaTemporal;
                    });
                    if ($reserva) {
                        echo 'data-id="' . $reserva->id . '"';
                    }
                @endphp>
                @php
                    if ($reserva) {
                        echo 'Reservado';
                    }
                @endphp
            </td>
            @endforeach
        </tr>
        @endforeach
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let celdasReserva = document.querySelectorAll('.reserva-celda');
        celdasReserva.forEach(function(celda) {
            if (celda.textContent.trim() === 'Reservado') {
                celda.classList.add('reservado');
                celda.style.cursor = 'pointer';
                celda.addEventListener('click', function() {
                    var idReserva = this.getAttribute('data-id');
                    window.location.href = '/reserva/informacion/' + idReserva;
                });
            }
        });

        let botonAnterior = document.getElementById('anterior');
        let semanaActual = '{{ \Carbon\Carbon::now()->startOfWeek()->format("Y-m-d") }}';
        let inicioSemanaActual = '{{ $inicioSemana->copy()->startOfWeek()->format("Y-m-d") }}';
        if (semanaActual === inicioSemanaActual) {
            botonAnterior.classList.add('deshabilitado');
            botonAnterior.removeAttribute('href');
        }
    });
</script>
@endsection
