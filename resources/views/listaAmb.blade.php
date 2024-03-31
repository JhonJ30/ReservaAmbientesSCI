@extends('layout/plantilla')
@section('contenido')

<script>
        // Verifica si hay un mensaje de éxito en la sesión y muestra una alerta si es así
        @if(session('success'))
            alert("{{ session('success') }}");
        @endif
    </script>
<!--ver lista de ambientes registrados -->
<link href="{{asset ('css/listaA.css')}}" rel="stylesheet">
<br>
<h2>Lista de Ambientes</h2>
<br>
<div class="search-container">
  <input type="text" placeholder="Buscar..." class="search-input">
  <button class="search-button"><i class="fas fa-search"></i></button>
</div>
<br>
<div> 
<table>
  <thead>
    <tr>
      <th>Nro</th>
      <th>capacidad</th>
      <th>Ubicacion</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos as $item )
    <tr>
      <td>{{$item->nroAmb}}</td>
      <td>{{$item->capacidad}}</td>
      <td>{{$item->ubicacion}}</td>
      <td>{{$item->estado}}</td>
      <td>
      <button class="edit-btn" onclick="window.location.href='{{ route('ambientes.editar', $item->id) }}'">Modificar</button>
        <button class="delete-btn" onclick="alert('Eliminar entrada 2')">Eliminar</button>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection