@php
    $userId = auth()->id();
    $ambientes = App\Models\Reservar::where('codUser', $userId)->get();
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css>
    <link href="{{asset ('css/home.css')}}" rel="stylesheet">
    <title>Reservas-UMSS</title>
</head>
<body>

<div class="main"> 
    <div class="navbar">
        <div class="logo">
            <img src="{{asset ('img/san simon.png')}}" class="logo" alt="...">
            <span class="logo-text">RESERVA DE AMBIENTES</span>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="menu">
            <li> <a href="/" class="priHabilitadoInicio"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
            <li><a href="#" id="menuRegistrar" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Registrar</a>
                <ul class="submenu" id="submenuRegistrar">
                    <p><a href="/registroAmbiente" class="priHabilitado2">&nbsp;&nbsp;Ambientes</a></p>
                    <p><a href="/registroHorario" class="priHabilitado2">&nbsp;&nbsp;Horarios</a></p>
                    <p><a href="/registroMateria" class="priHabilitado2">&nbsp;&nbsp;Materias</a></p>
                    <p><a href="/registroUsuario" class="priHabilitado2">&nbsp;&nbsp;Usuarios</a></p>
                    <p><a href="/registrarBackup" class="priHabilitado2">&nbsp;&nbsp;Backups</a></p>
                </ul>
            </li>
            <li><a href="#" id="menuRegistrar2" class="priHabilitado2"><i class="fas fa-eye"></i>&nbsp;Visualizar</a>
                <ul class="submenu" id="submenuRegistrar2">
                    <p><a href="/listaReservas" class="priHabilitado2">&nbsp;&nbsp;Reservas</a></p>
                    <p><a href="/listaAmbientes" class="priHabilitado2">&nbsp;&nbsp;Ambientes</a></p>
                    <p><a href="/listaHorarios" class="priHabilitado2">&nbsp;&nbsp;Horarios</a></p>
                    <p><a href="/listaMaterias" class="priHabilitado2">&nbsp;&nbsp;Materias</a></p>
                    <p><a href="/listaUsuarios" class="priHabilitado2">&nbsp;&nbsp;Usuarios</a></p>
                </ul>
            </li>
            <li> <a href="/viewlistAviso" class="ultimo">&nbsp;Avisos</a></li>

            <div onmouseover="showMiCuentaContent()" onmouseout="hideMiCuentaContent()">
                <li><a href="#" class='iniSesion'><i class="fas fa-user"></i>Mi Cuenta</a></li>
                <div id="miCuentaContent" class="miCuentaContent" style="display: none;">
                    <div class="container-reservas">
                        <div class="logo-reservas">
                            <i class="fas fa-user-circle icon-color"></i>
                            <h2>{{ Auth::user()->apellido }} {{ Auth::user()->nombre }}</h2>
                        </div>
                        <h2>Reservas</h2>
                        @if ($ambientes->isEmpty())
                        <p style="font-size: 20px; color: gray;">No hay reservas.</p>
                        @else
                        <ul>
                            @foreach ($ambientes as $ambiente)
                            @php
                                $nombre = DB::table('ambiente')->where('id', $ambiente->codAmb)->first();
                            @endphp
                            <li>
                                <span>Aula: {{ $nombre->nroAmb }}<br>
                                    Fecha: {{ $ambiente->fecha }}<br>
                                    Hora: {{ $ambiente->horaInicio }}<br>
                                    Estado: {{ $ambiente->estado }}
                                </span>
                                @if ($ambiente->estado == 'Proceso')
                                
                                <a href="{{ route('editarReserva', $ambiente->id) }}" class="editar-button" style="color:#ffff; font-weight: normal;" >Modificar</a>
                                <a href="{{ route('eliminarReserva', $ambiente->id) }}" class="cancel-button" style="color:#ffff; font-weight: normal;">Cancelar</a>

                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <button class="cancel-button2" id="cancel-button2">Cerrar Sesión
                            <i class="fas fa-right-from-bracket"></i>
                        </button>
                    </div>
                </div>
        </ul>
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
   
    <div class="container">
        @yield('contenido')
    </div>
    <div class="footer">
        @include('layout.footer')
    </div>
</div>    
</body>

<script>
        function toggleMenu() {
            const menu = document.querySelector('.menu');
            menu.classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const menuRegistrar = document.getElementById('menuRegistrar');
            menuRegistrar.addEventListener('click', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto del enlace.
                const submenu = document.getElementById('submenuRegistrar');
                submenu.classList.toggle('active'); // Muestra u oculta el submenú.
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const menuRegistrar = document.getElementById('menuRegistrar2');
            menuRegistrar.addEventListener('click', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto del enlace.
                const submenu = document.getElementById('submenuRegistrar2');
                submenu.classList.toggle('active'); // Muestra u oculta el submenú.
            });
        });

        document.getElementById('cancel-button2').addEventListener('click', function() {
            window.location.href = "/logout";
        });

        function showMiCuentaContent() {
            document.getElementById("miCuentaContent").style.display = "block";
        }

        function hideMiCuentaContent() {
            document.getElementById("miCuentaContent").style.display = "none";
        }
        function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
  }
    </script>
   
</html>