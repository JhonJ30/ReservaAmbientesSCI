@extends('layout/plantillaAdmin')
@section('contenido')

<link href="{{asset ('css/listaH.css')}}" rel="stylesheet">
<br>
<h2>LISTA DE USUARIOS</h2>
<br>
      <form action="{{ route('usuarios.search') }}" method="GET">
      <div class="search-container">
            <input type="text" name="search" placeholder="Buscar por código sis" class="search-input">
            <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
      </div>
      </form> 
<br>
<div> 
<table class="listaUsuarios">
  <thead>
    <tr>
      <th style="text-align: center;">Código sis</th>
      <th style="text-align: center;">Nombre</th>
      <th style="text-align: center;">Apellido</th>
      <th style="text-align: center;">Rol</th>
      <th style="text-align: center;">Correo electrónico</th>
      <th style="text-align: center;">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($usuarios as $item)
    @if($item->id != 1001)
      <tr>
        <td style="text-align: center;">{{$item->codSis}}</td>
        <td style="text-align: center;">{{$item->nombre}}</td>
        <td style="text-align: center;">{{$item->apellido}}</td>
        <td style="text-align: center;">{{$item->rol}}</td>
        <td style="text-align: center;">{{$item->email}}</td>
        <td style="text-align: center;">
          <button class="edit-btn" onclick="window.location.href='{{ route('usuarios.editar', $item->id) }}'">Modificar</button>
          <button  class="delete-btn" onclick="openModal({{ $item->id }})" >Eliminar</button>
        </td>
      </tr>
    @endif
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
    <form action="{{route('usuarios.destroy')}}" method="POST">
            @csrf
            
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="registro_id" id="registro_id">
    <button class="btnAceptar" type="submit">Aceptar</button>
</form>
    <button class="btnCancelar"onclick="closeModal()">Cancelar</button>
  </div>
  </div>
</div>

<br>
<br>
<script>
   function openModal(registroId) {
    document.getElementById('registro_id').value = registroId;
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
</script>


@endsection