@extends('layout.plantillaAdmin')

@section('contenido')
    <link href="{{ asset('css/backup.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <form action="{{ route('backups.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return error()">
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
                <button class="botonCancelar" onclick="redireccionarAVista()">Cancelar</button>
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




    <script>
        // Obtener el modal
        var modal = document.getElementById("backupSuccessModal");

        // Obtener el botón para cerrar el modal
        var span = document.getElementsByClassName("close")[0];

        // Cuando el usuario haga clic en <span> (x), cierre el modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario haga clic en cualquier parte fuera del modal, ciérrelo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Función para mostrar el modal cuando se registre correctamente un backup
        function showBackupSuccessModal() {
            modal.style.display = "block";
        }
        function redireccionarAVista() {
        // Cambiar la ubicación actual del navegador a la URL de la otra vista
        window.location.href = "{{ route('home') }}";
    }

        // Verificar si hay sesión de éxito y mostrar el modal si es necesario
        @if(session('success'))
            showBackupSuccessModal();
        @endif
    </script>
@endsection
