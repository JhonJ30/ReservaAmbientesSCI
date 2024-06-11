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

        

        <button type="button" class="edit-btn" onclick="window.location.href='{{ route('avisos.editar', $item->id) }}'">Modificar</button>
        <button type="button" class="delete-btn" onclick="openModalE({{ $item->id }})" >Eliminar</button>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

<!-- Modal de confirmación de eliminación -->
<div id="myModalE" class="modal">
 
  <div class="modal-content1">
    <p><strong>¿Estás seguro que deseas eliminar este registro?</strong></p>
    <br>
    <p class="gris">Esta operacion es irreversible</p>
    <br>
    <div class="button-container1">
    <form action="{{route('avisos.eliminar')}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="registro_id" id="registro_id">
       <button class="btnAceptar" type="submit" >Aceptar</button>
      </form>
    <button class="btnCancelar"onclick="closeModalE()">Cancelar</button>
  </div>
  </div>
</div>

<!-- Formulario de registro de avisos -->

<div id="myModal" class="modal">
        <div class="modal-content">
            <h2>PUBLICAR AVISO</h2>
            <br>
            <div class="button-container">
                <form id="avisoForm" action="{{ route('avisos.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-column">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de inicio:</label><br>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                                <span class="error-message" id="fecha_inicio_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="titulo">Título:</label><br>
                                <input type="text" id="titulo" name="titulo" required>
                                <span class="error-message" id="titulo_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="archivo">Subir archivo:</label><br>
                                <input type="file" id="archivo" name="archivo"> 
                                <span class="error-message" id="archivo_error"></span>  
                            </div>
                        </div>
                        <div class="form-column">
                            <div class="form-group">
                                <label for="fecha_fin">Fecha y hora fin:</label><br>
                                <input type="datetime-local" id="fecha_fin" name="fecha_fin" required>
                                <span class="error-message" id="fecha_fin_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label><br>
                                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                                <span class="error-message" id="descripcion_error"></span>
                            </div>
                        </div>  
                    </div>
                    <div class="botones">
                        <button type="button" class="btnCancelar" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="btnRegistrar">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
  /*validar formulario*/
  document.getElementById('avisoForm').addEventListener('submit', function(event) {
            var isValid = true;
            var today = new Date().toISOString().split('T')[0];
            var fechaInicio = document.getElementById('fecha_inicio').value;
            var fechaFin = document.getElementById('fecha_fin').value;
            var titulo = document.getElementById('titulo').value;
            var descripcion = document.getElementById('descripcion').value;
            var archivo = document.getElementById('archivo').files[0];
            var maxFileSize = 2 * 1024 *1024; // 3 MB

            // Limpiar mensajes de error
            document.getElementById('fecha_inicio_error').textContent = '';
            document.getElementById('fecha_fin_error').textContent = '';
            document.getElementById('titulo_error').textContent = '';
            document.getElementById('descripcion_error').textContent = '';
            document.getElementById('archivo_error').textContent = '';

            // Validar fecha de inicio
            if (fechaInicio < today) {
                isValid = false;
                document.getElementById('fecha_inicio_error').textContent = 'La fecha de inicio debe ser hoy o una fecha futura.';
            }

            // Validar fecha de fin
            if (fechaFin < today) {
                isValid = false;
                document.getElementById('fecha_fin_error').textContent = 'La fecha y hora de fin deben ser hoy o en el futuro.';
            }


            // Validar título
            if (!/^[a-zA-Z0-9\s]+$/.test(titulo)) {
                isValid = false;
                document.getElementById('titulo_error').textContent = 'El título solo debe contener letras y numeros';
            }

            // Validar descripción
            if (!/^[a-zA-Z0-9\s]+$/.test(descripcion)) {
                isValid = false;
                document.getElementById('descripcion_error').textContent = 'La descripción solo debe contener letras y numeros';
            }
         // Validar tamaño del archivo
         if (archivo && archivo.size > maxFileSize) {
                isValid = false;
                document.getElementById('archivo_error').textContent = 'El archivo no debe superar los 2MB.';
            }

            if (!isValid) {
                event.preventDefault();
            }
        });





   // Función para abrir el modal
   function openModal() {
    // Mostrar el modal
        document.getElementById('myModal').style.display = 'block';
    }
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
    function openModalE(registroId) {
    document.getElementById('registro_id').value = registroId;
        document.getElementById('myModalE').style.display = 'block';
    }
    function closeModalE() {
        document.getElementById('myModalE').style.display = 'none';
    }
    
</script>

@endsection