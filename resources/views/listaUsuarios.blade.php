@extends('layout/plantilla')
@section('contenido')

<link href="{{asset ('css/listaH.css')}}" rel="stylesheet">
<br>
<h2>LISTA DE USUARIOS</h2>
<br>
      <form action="/listaU/search" method="GET">
      <div class="search-container">
            <input type="text" name="search" placeholder="Buscar usuario" class="search-input">
            <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
      </div>
      </form> 
<br>
<div> 
<table>
  <thead>
    <tr>
      <th style="text-align: center;">Nombre</th>
      <th style="text-align: center;">Apellido</th>
      <th style="text-align: center;">Correo electrónico</th>
      <th style="text-align: center;">Código sis</th>
      <th style="text-align: center;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($usuarios as $item)
    <tr>
      <td style="text-align: center;">{{$item->nombre}}</td>
      <td style="text-align: center;">{{$item->apellido}}</td>
      <td style="text-align: center;">{{$item->correo}}</td>
      <td style="text-align: center;">{{$item->codSis}}</td>
      <td style="text-align: center;">
        <button class="edit-btn" onclick="">Modificar</button>
        <button  class="delete-btn" onclick="" >Eliminar</button>
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
            <div class="button-container">
                <button class="btnAceptar" onclick="closeSuccessModal()">Aceptar</button>
            </div>
        </div>
    </div>
@endif

<script>
   function openModal(registroId) {
    document.getElementById('registro_id').value = registroId;
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}

</script>


@endsection