@extends('layout.plantillaAdmin')

@section('contenido')
    <link href="{{ asset('css/backup.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <form id="backupForm" action="{{ route('backups.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="registro">
            <div class="titulo-registro">
                <h1>REGISTRO DE BACKUP</h1>
            </div>
            <div class="contenido-registro">
                <div class="col1">
                    <label for="backup-file" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Subir archivo Backup(*)
                    </label>
                    <input id="backup-file" type="file" name="backup" required>
                    <div class="texto-error-advertencia" id="error-message" style="color: red; display: none;"></div>
                </div>
            </div>
            <div class="botones">
                <button type="button" class="botonCancelar" onclick="redireccionarAVista()">Cancelar</button>
                <button class="botonRegistrar" type="submit">Registrar</button>
            </div>
        </div>
    </form>

    <!-- Modal de Confirmación de Backup -->
    <div class="modal" id="backupSuccessModal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <p>¡El backup se ha registrado correctamente!</p>
            <button class="botonAceptar" onclick="redireccionarAVista()">Aceptar</button>
        </div>
    </div>

    <!-- Modal de Error de Formato de Archivo -->
    <div class="modal" id="fileErrorModal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <p>Formato de archivo incorrecto. Por favor, suba un archivo PDF o TXT.</p>
            <button class="botonAceptar" onclick="cerrarModal()">Aceptar</button>
        </div>
    </div>

    @if(Session::has('success'))
<div id="successModal" class="modal" style="display: block; background-color: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
  <div class="modal-content" style="background-color: white; width: 50%; margin: 20% auto; padding: 20px; border-radius: 5px; text-align: center;">
    <p><strong>{{ Session::get('success') }}</strong></p>
    <!-- Otro contenido del modal si es necesario -->
    <div class="button-container">
      <button class="btnAceptar" style="background-color: #0B6F63; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="closeSuccessModal()">Aceptar</button>
    </div>
  </div>
</div>
@endif


    <script>
        document.getElementById('backupForm').onsubmit = function(e) {
            var fileInput = document.getElementById('backup-file');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.pdf|\.txt)$/i;

            if (!allowedExtensions.exec(filePath)) {
                e.preventDefault();
                showFileErrorModal();
                return false;
            }
        };

        // Obtener los modales
        var successModal = document.getElementById("backupSuccessModal");
        var errorModal = document.getElementById("fileErrorModal");

        // Obtener los botones para cerrar los modales
        var spanCloseButtons = document.getElementsByClassName("close");

        // Cuando el usuario haga clic en <span> (x), cierre el modal correspondiente
        for (var i = 0; i < spanCloseButtons.length; i++) {
            spanCloseButtons[i].onclick = function() {
                cerrarModal();
            }
        }

        // Cuando el usuario haga clic en cualquier parte fuera del modal, ciérrelo
        window.onclick = function(event) {
            if (event.target == successModal) {
                successModal.style.display = "none";
            }
            if (event.target == errorModal) {
                errorModal.style.display = "none";
            }
        }

        // Función para mostrar el modal de éxito
        function showBackupSuccessModal() {
            successModal.style.display = "block";
        }

        // Función para mostrar el modal de error de archivo
        function showFileErrorModal() {
            errorModal.style.display = "block";
        }

        // Función para cerrar cualquier modal
        function cerrarModal() {
            successModal.style.display = "none";
            errorModal.style.display = "none";
        }

        function redireccionarAVista() {
            window.location.href = "{{ route('home') }}";
        }
        
  function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
  }

        // Verificar si hay sesión de éxito y mostrar el modal si es necesario
        @if(session('success2'))
            showBackupSuccessModal();
        @endif
    </script>
@endsection
