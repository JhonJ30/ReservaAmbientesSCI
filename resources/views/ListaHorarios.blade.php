@extends('layout/plantilla')
@section('contenido')


<!--ver lista de horarios registrados -->
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

@if(Session::has('success'))
    <div id="successModal" class="modal" style="display: block;">
        <div class="modal-content">
            <p><strong>{{ Session::get('success') }}</strong></p>
            <!-- Otro contenido del modal si es necesario -->
            <div class="button-container">
                <button class="btnAceptar" onclick="closeSuccessModal()">Aceptar</button>
            </div>
        </div>
    </div>
@endif

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
    fetch('/listaH/' + registroId, {
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


function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}

</script>


@endsection