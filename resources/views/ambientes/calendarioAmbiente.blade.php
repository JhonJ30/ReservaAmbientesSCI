@extends(Auth::check() && Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' : 'layout.plantillaInvitado')

@section('contenido')
<link href="{{asset ('css/calendario.css')}}" rel="stylesheet">

<h1 class="aviso">{{ $nroAula }}: CALENDARIO</h1>
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

        $inicioSemana = \Carbon\Carbon::now()->startOfWeek()->toDateString();
        $finSemana = \Carbon\Carbon::now()->endOfWeek()->toDateString();

        $reservas = \DB::table('reserva')
        ->where('codAmb', $idAmbiente)
        ->whereBetween('fecha', [$inicioSemana, $finSemana])
        ->where('estado', 'Aceptado')
        ->get();
        @endphp

        @foreach($horarios as $hora)
        <tr>
            <td>{{ $hora }}</td>
            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia)
            <td class="reserva-celda">
                @php
                $fechaDia = \Carbon\Carbon::now()->startOfWeek()->addDays($loop->index)->format('Y-m-d');

                $reserva = $reservas->first(function ($reserva) use ($fechaDia, $hora) {
                    $horaTemporal = strtotime($hora);
                    $horaInicioTemporal = strtotime($reserva->horaInicio);
                    return $reserva->fecha === $fechaDia && $horaInicioTemporal === $horaTemporal;
                });

                echo $reserva ? 'Reservado' : '';
                @endphp
            </td>
            @endforeach
        </tr>
        @endforeach



    </table>
</div>

<button type="button" class="cancelar-btn" onclick="window.location.href='/verAmbientes'">Cancelar</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var celdasReserva = document.querySelectorAll('.reserva-celda');
        celdasReserva.forEach(function(celda) {
            if (celda.textContent.trim() === 'Reservado') {
                celda.classList.add('reservado');
            }
        });
    });
</script>
@endsection