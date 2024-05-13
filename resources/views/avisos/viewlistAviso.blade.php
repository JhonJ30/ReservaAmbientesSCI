@extends(Auth::check() ? 
    (Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' : 
    (Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' : 
    'layout.plantillaInvitado')) 
: 'layout.plantillaInvitado')

@section('contenido')
<!--ver lista de ambientes registrados -->
<link href="{{asset ('css/avisos.css')}}" rel="stylesheet">
<br>

<div class="container">
<h2>LISTA DE AVISOS</h2>
<button class="add-button" onclick="openModal()"><i class="fas fa-plus"></i>&nbsp;Añadir</button>
</div>
<br>
<div> 
<table>
  <thead>
    <tr>
      <th style="text-align: center;">Titulo</th>
      <th style="text-align: center;">Fecha Inicio</th>
      <th style="text-align: center;">Fecha Fin</th>
      <th style="text-align: center;">Estado</th>
      <th style="text-align: center;">Accion</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($avisos as $item)
    <tr>
      <td style="text-align: center;">{{$item->titulo}}</td>
      <td style="text-align: center;">{{$item->fecInicio}}</td>
      <td style="text-align: center;">{{$item->fecFin}}</td>
      <td style="text-align: center;">{{$item->estado}}</td>
      <td style="text-align: center;">

        <button type="button"  class="edit-btn">Modificar</button>
        <button type="button" class="delete-btn" onclick="#">Eliminar</button>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

<!-- Modal de confirmación de eliminación -->

<div id="myModal" class="modal">
  <div class="modal-content">
    <h2>PUBLICAR AVISO</h2>
    <br>
    <div class="button-container">
        <form action="{{ route('avisos.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de inicio:</label><br>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Título:</label><br>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Subir archivo:</label><br>
                        <input type="file" id="archivo" name="archivo">   
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="fecha_fin">Fecha y hora fin:</label><br>
                        <input type="datetime-local" id="fecha_fin" name="fecha_fin" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label><br>
                        <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                    </div>
                    
                </div>  
               
            </div>
 
            <div class="botones">
                <button type="button" class="btnCancelar"onclick="closeModal()">Cancelar</button>
                <button  type="submit" class="btnRegistrar" >Registrar</button>
            </div>
        </form>
    
  </div>
  </div>
</div>

<script>
   // Función para abrir el modal
   function openModal() {
    // Mostrar el modal
        document.getElementById('myModal').style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
    
</script>

@endsection