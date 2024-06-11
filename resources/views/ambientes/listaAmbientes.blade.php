@extends('layout/plantillaAdmin')

@section('contenido')
<link href="{{asset ('css/listaA.css')}}" rel="stylesheet">
<br>
<h2>LISTA DE AMBIENTES</h2>
<br>
<!--buscador -->
<form action="{{ route('ambientes.search') }}" method="GET">
  <div class="search-container">

    <input type="text" name="search" placeholder="Buscar por nro de  ambiente.." class="search-input">
    <button class="search-button" type="submit"><i class="fas fa-search"></i></button>

  </div>
</form>

<br>
<div>
  <table>
    <thead>
      <tr>
        <th style="text-align: center;">Nro</th>
        <th style="text-align: center;">Capacidad</th>
        <th style="text-align: center;">Ubicacion</th>
        <th style="text-align: center;">Estado</th>
        <th style="text-align: center;">Acciones</th>
        <th style="text-align: center;">Reservas</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($ambientes as $item)
<tr>
    <td style="text-align: center;">{{$item->nroAmb}}</td>
    <td style="text-align: center;">{{$item->capacidad}}</td>
    <td style="text-align: center;">{{$item->ubicacion}}</td>
    <td style="text-align: center;">{{$item->estado}}</td>
    <td style="text-align: center;">
        <button class="edit-btn" onclick="window.location.href='{{ route('ambientes.editar', $item->id) }}'">Modificar</button>
        <button class="delete-btn" onclick="openModal({{ $item->id }})">Eliminar</button>
    </td>
    <td style="text-align: center;">
        @if($item->estado == 'Disponible')
        <button class="edit-btn" onclick="window.location.href='{{ route('reservas.show', ['ambiente_id' => $item->id, 'nro_ambiente' => $item->nroAmb]) }}'">Reservar</button>
        @else
        <button class="edit-btn" disabled>Reservar</button>
        @endif
    </td>
</tr>
@endforeach

    </tbody>
  </table>
</div>



<!-- Modal de confirmación de eliminación -->
<div id="myModal" class="modal">

  <div class="modal-content">
    <p><strong>¿Estás seguro que deseas eliminar este registro?</strong></p>
    <br>
    <p class="gris">Esta operacion es irreversible</p>
    <br>
    <div class="button-container">
      <form action="{{route('ambientes.destroy')}}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="registro_id" id="registro_id">
        <button class="btnAceptar" type="submit">Aceptar</button>
      </form>
      <button class="btnCancelar" onclick="closeModal()">Cancelar</button>
    </div>
  </div>
</div>

<script>
  // Función para abrir el modal
  function openModal(registroId) {
    document.getElementById('registro_id').value = registroId;
    // Mostrar el modal
    document.getElementById('myModal').style.display = 'block';
  }

  // Función para cerrar el modal
  function closeModal() {
    document.getElementById('myModal').style.display = 'none';
  }
</script>


@endsection