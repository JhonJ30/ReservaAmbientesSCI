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
        <button class="delete-btn" onclick="openModal()">Eliminar</button>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
<!--ventana modal de eliminar-->
<div id="myModal" class="modal">
  <!-- Contenido del modal -->
  <div class="modal-content">
    <p><strong>¿Estás seguro que deseas eliminar este registro?</strong></p>
    <br>
    <p class="gris">Esta operacion es irreversible</p>
    <br>
    <!-- Botones de confirmar y cancelar -->
    <div class="button-container">
    <button class="btnAceptar" onclick="deleteItem()">Aceptar</button>
    <button class="btnCancelar"onclick="closeModal()">Cancelar</button>
  </div>
  </div>
</div>

<script>
    // Función para abrir el modal
    function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Función para eliminar el elemento (simulado)
    function deleteItem() {
        // Aquí pondrías la lógica real para eliminar el elemento
        alert('Elemento eliminado');
        // Cerrar el modal después de eliminar
        closeModal();
    }
</script>
@endsection