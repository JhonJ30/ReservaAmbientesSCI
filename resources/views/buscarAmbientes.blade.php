@extends('layout/plantillaUser')
@section('contenido')

<link href="{{asset ('css/search.css')}}" rel="stylesheet">
<div>
<div class="search-container">
    @include('components.search')
</div>
<br>
<div> 
    @if (!empty($ambientes))
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
                                <button onclick="window.location.href='/client/verAmbientes/calendario/{{ $ambiente->id }}'">
                                    <i class="fas fa-calendar-days"></i>
                                </button>
                            </td>
                            <td> <!--columna de RESERVAR cambios sara-->
                                <button onclick="window.location.href='{{ route('cliente.reservar', ['ambiente_id' => $ambiente->id]) }}'">Reservar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p style="text-align:left; margin-left: 100px; margin-top:20px">No se encontraron resultados</p>
    @endif
</div>
</div>
@endsection
