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
        <button  class="delete-btn" onclick="openModal({{ $item->id }})" >Eliminar</button>
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
    <button class="btnAceptar" id="confirmDeleteBtn">Aceptar</button>
    <button class="btnCancelar"onclick="closeModal()">Cancelar</button>
  </div>
  </div>
</div>

<script>
   // Función para abrir el modal
   function openModal(registroId) {
    var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    // Guardar el ID del registro en un atributo data del botón de confirmación
    confirmDeleteBtn.setAttribute('data-id', registroId);

    // Mostrar el modal
        document.getElementById('myModal').style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
// Manejar el clic en el botón de eliminar en el modal
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    var registroId = this.getAttribute('data-id');
    
    // Enviar una solicitud DELETE al servidor
    fetch('/listaA/' + registroId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Recargar la página o actualizar la lista de registros
            window.location.reload();
        } else {
            console.error('Error al eliminar el registro');
        }
    })
    .catch(error => {
        console.error('Error de red:', error);
    });
});
</script>

@endsection