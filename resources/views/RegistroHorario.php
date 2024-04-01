extends('layout/plantilla')
@section('contenido')
<!--hasta aqui menu-->
<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<h1>Horarios Registrados</h1>

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
      <th>Tipo de ambiente</th>
      <th>Ambiente</th>
      <th>Hora de inicio</th>
      <th>Hora de fin</th>
      <th>Intervalo</th>
    </tr>
  </thead>
  <tbody>
    
    <tr>
        <button class="edit-btn" onclick="window.location.href='{{ route('ambientes.editar', $item->id) }}'">Modificar</button>
        <button  class="delete-btn" onclick="openModal({{ $item->id }})" >Eliminar</button>
      </td>
    </tr>
    </tbody>
</table>
</div>
<div id="myModal" class="modal">
 
  <div class="modal-content">
    <p><strong>¿Estás seguro que deseas eliminar este Horario?</strong></p>
    <br>
    <p class="gris">Esta operacion es irreversible</p>
    <br>
    <div class="button-container">
    <button class="btnAceptar" id="confirmDeleteBtn">Aceptar</button>
    <button class="btnCancelar"onclick="closeModal()">Cancelar</button>
  </div>
  </div>
</div>

