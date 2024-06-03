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
    <link href="{{asset ('css/homeUser.css')}}" rel="stylesheet">
    <title>@yield('titulopagina')</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{asset ('img/san simon.png')}}" class="logo" alt="...">
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="menu">
            <li> <a href="/" class="priHabilitadoInicio"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
            <li><a href="/verAmbientes" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Ver Ambientes</a></li>
            
            <li><a href="/notificacion" id="notificacionLink"  class="ultimo" ><i class="fas fa-bell"><sup id="contadorNotificaciones" style="color: red;">
            {{ App\Http\Controllers\notificationController::contarNotificacionesRecientes() }}</sup></i>
            </a></li>

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
                            <li>
                                <span>Aula: {{ $ambiente->codAmb }}<br>
                                    Fecha: {{ $ambiente->fecha }}<br>
                                    Hora: {{ $ambiente->horaInicio }}<br>
                                    Estado: {{ $ambiente->estado }}
                                </span>
                                @if ($ambiente->estado == 'Proceso')
                                <a href="{{ route('editarReserva', $ambiente->id) }}" class="editar-button"><span class="texto-blanco">Modificar</span></a>
                                @endif
                                <button class="cancel-button" onclick="openModal2({{ $ambiente->id }})">Cancelar</button>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="footer">
                            <button class="cancel-button2" id="cancel-button2">Cerrar Sesión
                                <i class="fas fa-right-from-bracket"></i>
                            </button>
                        </div>
                    </div>
                </div>
        </ul>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div id="myModal" class="modal">

        <div class="modal-content">
            <p><strong>¿Estás seguro que quiere cancelar su Reserva?</strong></p>
            <br>
            <p class="gris">Esta operacion es irreversible</p>
            <br>
            <div class="button-container">
                <form method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="registro_id" id="registro_id">
                    <button class="btnAceptar" type="submit">Aceptar</button>
                </form>
                <button class="btnCancelar" onclick="closeModal2()">Cancelar</button>
            </div>
        </div>
    </div>
    <div class="container">
        @yield('contenido')
    </div>
</body>
   
<div>
    <br>
    <br>
    <br>
</div>
@include('layout.footer')
<script>
    function toggleMenu() {
        const menu = document.querySelector('.menu');
        const container = document.querySelector('.container');

        menu.classList.toggle('active');

        if (menu.classList.contains('active')) {
            container.style.marginTop = '250px';
        } else {
            container.style.marginTop = '0';
        }
    }

    window.addEventListener('resize', function() {
        const menu = document.querySelector('.menu');
        const container = document.querySelector('.container');

        if (window.matchMedia('(min-width: 769px)').matches) {
            menu.classList.remove('active');
            container.style.marginTop = '0';
        }
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

    // Función para abrir el modal
    function openModal2(registroId) {
        document.getElementById('registro_id').value = registroId;
        console.log(registroId);
        // Mostrar el modal
        document.getElementById('myModal').style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal2() {
        document.getElementById('myModal').style.display = 'none';
    }

    //notificacion
    
    document.getElementById('notificacionLink').addEventListener('click', function() {
        document.getElementById('contadorNotificaciones').textContent = '0';
    });


</script>

</html>