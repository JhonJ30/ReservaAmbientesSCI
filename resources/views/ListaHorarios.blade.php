@extends('layout/plantilla')
@section('contenido')


<!--ver lista de ambientes registrados -->
<link href="{{asset ('css/listaA.css')}}" rel="stylesheet">
<br>
<h2>Lista de Horarios</h2>
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
      <th>Tipo de Ambiente</th>
      <th>Ambiente</th>
      <th>Hora de inicio</th>
      <th>Hora de fin</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos as $item )
    <tr>
      <td>{{$item->tipoAmbiente}}</td>
      <td>{{$item->ambi}}</td>
      <td>{{$item->horaInicio}}</td>
      <td>{{$item->horaFin}}</td>
      <td>
      <button class="edit-btn" onclick=" ">Modificar</button>
        <button  class="delete-btn" onclick=" " >Eliminar</button>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>



@endsection