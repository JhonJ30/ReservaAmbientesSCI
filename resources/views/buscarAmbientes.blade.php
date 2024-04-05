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
