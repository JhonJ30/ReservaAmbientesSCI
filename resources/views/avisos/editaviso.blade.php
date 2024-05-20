@extends(Auth::check() ? 
    (Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' : 
    (Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' : 
    'layout.plantillaInvitado')) 
: 'layout.plantillaInvitado')

@section('contenido')

<div id="myModal" class="modal">
  <div class="modal-content">
    <h2>MODIFICAR AVISO</h2>
    <br>
    <div class="button-container">
        <form action="{{ route('avisos.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de inicio:</label><br>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" required value="{{ $avisos->fecInicio }}">
                    </div>
                    <div class="form-group">
                        <label for="titulo">Título:</label><br>
                        <input type="text" id="titulo" name="titulo" required value="{{ $avisos->titulo }}">
                    </div>
                    <div class="form-group">
                        <label for="archivo">Subir archivo:</label><br>
                        <input type="file" id="archivo" name="archivo" required value="{{ $avisos->archivo }}">   
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="fecha_fin">Fecha y hora fin:</label><br>
                        <input type="datetime-local" id="fecha_fin" name="fecha_fin" required value="{{ $avisos->fecFin }}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label><br>
                        <textarea id="descripcion" name="descripcion" rows="4" required>{{ $aviso->descripcion }}</textarea>
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
    // Función para cerrar el modal
    function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}
    
    
</script>

@endsection