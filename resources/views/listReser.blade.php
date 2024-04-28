@extends('layout/plantilla')
@section('contenido')


<!--ver lista de ambientes registrados -->
<link href="{{asset ('css/listaA.css')}}" rel="stylesheet">
<br>
<h2>Lista de Reservas</h2>
<br>
<div> 
<table>
  <thead>
    <tr>
      <th style="text-align: center;">Fecha</th>
      <th style="text-align: center;">Hora</th>
      <th style="text-align: center;">Ambiente</th>
      <th style="text-align: center;">Usuario</th>
      <th style="text-align: center;">Actividad</th>
      <th style="text-align: center;">Accion</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($reservas as $item )
    <tr>
      <td style="text-align: center;">{{$item->fecha}}</td>
      <td style="text-align: center;">{{$item->horaInicio}} - {{$item->horaFin}}</td>
      <td style="text-align: center;">{{$item->codAmb}}</td>
      <td style="text-align: center;">{{$item->nombre}} {{$item->apellido}}</td>
      <td style="text-align: center;">{{$item->Actividad}}</td>
      <td style="text-align: center;">
      <form method="POST" action="{{ route('notificaciones.store') }}">
        @csrf
        <input type="hidden" name="reserva_id" value="{{$item->id}}">
        <button type="submit"  class="edit-btn">Aceptar</button>
        <button type="button" class="delete-btn" onclick="openModal({{ $item->id }})">Rechazar</button>
      </form>  
        
  
      </td>
    </tr>
  @endforeach
   
  </tbody>
</table>
</div>

<!-- Modal de confirmación de eliminación -->
<div id="myModal" class="modal">
 
  <div class="modal-content">
    <p><strong>¿Estás seguro que desea rechazar esta solicitud?</strong></p>
    <br>
    <p class="gris">Esta operacion es irreversible</p>
    <br>
    <div class="button-container">
    <form method="POST" action="{{ route('notificaciones.Rechazar') }}">
    @csrf
            <input type="hidden" name="reserva_id" id="reserva_id">
       <button class="btnAceptar" type="submit" >Aceptar</button>
      </form>
    <button class="btnCancelar"onclick="closeModal()">Cancelar</button>
  </div>
  </div>
</div>

<script>
   // Función para abrir el modal
   function openModal(registroId) {
    document.getElementById('reserva_id').value = registroId;
    // Mostrar el modal
        document.getElementById('myModal').style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
    function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}



</script>
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

@endsection
