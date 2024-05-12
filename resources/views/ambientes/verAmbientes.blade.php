@extends(Auth::check() ?
(Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' :
(Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' :
'layout.plantillaInvitado'))
: 'layout.plantillaInvitado')

@section('contenido')
<link href="{{asset ('css/search.css')}}" rel="stylesheet">

<div>
    <div class="search-container">
        @include('components.search')
    </div>
    <br>
    <div>
        @if (!$ambientes->isEmpty())
        <div class="listClassroom">
            <table>
                <thead>
                    <tr>
                        <th>Nro Aula</th>
                        <th>Capacidad</th>
                        <th>Ubicación</th>
                        <th>Recursos</th>
                        <th>Calendario</th>
                        <th>Reservas</th> <!--cambios sara-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ambientes as $ambiente)
                    <tr>
                        <td>{{ $ambiente->nroAmb }}</td>
                        <td>{{ $ambiente->capacidad }}</td>
                        <td>{{ $ambiente->ubicacion }}</td>
                        <td>{{ $ambiente->equipamiento }}</td>
                        <td>
                            <button onclick="window.location.href='/calendario/{{ $ambiente->id }}'">
                                <i class="fas fa-calendar-days"></i>
                            </button>
                        </td>
                        <td>
                            @auth
                            <button onclick="window.location.href='{{ route('reservas.show', ['ambiente_id' => $ambiente->id, 'nro_ambiente' => $ambiente->nroAmb]) }}'">Reservar</button>
                            @else
                            <button onclick="window.location.href='{{ route('iniciarSesion') }}'">Reservar</button>
                            @endauth
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="text-align:left; margin-left: 5%; margin-top:20px">No se encontraron resultados</p>
        @endif
    </div>
</div>
@endsection