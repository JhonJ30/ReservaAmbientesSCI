@extends('layout/plantillaUser')
@section('contenido')

<link href="{{asset ('css/search.css')}}" rel="stylesheet">
<div class="search-container">
    @include('components.search')
</div>
<br>
<div> 

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
          <tr>
            <td>Laboratorio</td>
            <td>30</td>
            <td>Laboratorio</td>
            <td>Pizarra, Proyector</td>
            <td>
                <button onclick="openModal()">
                    <i class="fas fa-calendar-days"></i>
                </button>
            </td>
          </tr>
          <tr>
            <td>Auditorio</td>
            <td>60</td>
            <td>Edificio Nuevo</td>
            <td>Pizarra</td>
            <td>
                <button onclick="openModal()">
                    <i class="fas fa-calendar-days"></i>
                </button>
            </td>
          </tr>
          <tr>
            <td>691A</td>
            <td>45</td>
            <td>Edificio Nuevo</td>
            <td>Pizarra, Proyector</td>
            <td>
                <button onclick="openModal()">
                    <i class="fas fa-calendar-days"></i>
                </button>
            </td>
          </tr>
      </table>
    </div>
@endsection