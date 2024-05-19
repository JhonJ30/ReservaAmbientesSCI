@extends(Auth::check() ?
(Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' :
(Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' :
'layout.plantillaInvitado'))
: 'layout.plantillaInvitado')

@section('contenido')
<link href="{{ asset('css/informacion.css') }}" rel="stylesheet">

<h1>INFORMACIÓN DE LA RESERVA</h1>

<div class="infoReserva">
    @php
        $ambiente = \App\Models\Ambientes::find($reserva->codAmb);
        $usuario = \App\Models\User::find($reserva->codUser);
        $materia = \App\Models\Materias::find($reserva->Materia);
    @endphp

    <p>Ambiente: {{ $ambiente->nroAmb }}</p>
    <p>Usuario: {{ $usuario->nombre }} {{ $usuario->apellido}}</p>
    <p>Materia: {{ $materia->nombre }}</p>
    <p>Actividad: {{ $reserva->Actividad }}</p>
    <p>Fecha: {{ $reserva->fecha }}</p>
    <p>Hora de inicio: {{ $reserva->horaInicio }}</p>
    <p>Hora de fin: {{ $reserva->horaFin }}</p>
</div>

<div style="text-align: center;">
    <a class="regresar-btn" href="{{ route('ambientes.calendario', ['id' => $reserva->codAmb]) }}">Regresar al calendario</a>
</div>
@endsection
