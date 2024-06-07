@extends('layout/plantillaAdmin')

@section('contenido')
<!--ver lista de horarios registrados -->
<link href="{{asset ('css/listaH.css')}}" rel="stylesheet">
<br>
<h2>LISTA DE HORARIOS</h2>
<br>
      <form action="{{ route('horarios.search') }}" method="GET">
      <div class="search-container">
            <input type="text" name="search" placeholder="Buscar por ambiente.." class="search-input">
            <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
      </div>
      </form> 
<br>
<div> 
<table>
  <thead>
    <tr>
      <th style="text-align: center;">Tipo de Ambiente</th>
      <th style="text-align: center;"> Dias</th>
      <th style="text-align: center;">Intervalo</th>
      <!--<th style="text-align: center;">Ambiente</th>-->
      <th style="text-align: center;">Hora de inicio</th>
      <th style="text-align: center;">Hora de fin</th>
      <th style="text-align: center;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos as $item )
    <tr>
      <td style="text-align: center;">{{$item->tipoAmbiente}}</td>
      <td style="text-align: center;">{{$item->dias}}</td>
      <td style="text-align: center;">{{$item->intervalo}}</td>
      <!--<td style="text-align: center;">{{$item->ambi}}</td>-->
      <td style="text-align: center;">{{$item->horaInicio}}</td>
      <td style="text-align: center;">{{$item->horaFin}}</td>
      <td style="text-align: center;">
      <button class="edit-btn" onclick="window.location.href='{{ route('horarios.edit', $item->id) }}'">Modificar</button>
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
    <form action="{{route('horarios.destroy')}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="registro_id" id="registro_id">
    <button class="btnAceptar" type="submit">Aceptar</button>
</form>
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
    document.getElementById('registro_id').value = registroId;
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


@endsection