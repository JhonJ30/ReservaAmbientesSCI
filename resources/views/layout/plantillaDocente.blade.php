@php
    $userId = auth()->id();
    $ambientes = App\Models\Reservar::where('codUser', $userId)->get();
    use Carbon\Carbon;
    $currentDate = Carbon::now();
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="{{ asset('css/homeUser.css') }}" rel="stylesheet">
    <title>@yield('titulopagina')</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('img/san simon.png') }}" class="logo" alt="...">
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="menu">
            <li><a href="/" class="priHabilitadoInicio"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
            <li><a href="/verAmbientes" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Ver Ambientes</a></li>
            <li><a href="/notificacion" id="notificacionLink" class="ultimo"><i class="fas fa-bell"><sup id="contadorNotificaciones" style="color: red;">
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
                                    @php
                                        $nombre = DB::table('ambiente')->where('id', $ambiente->codAmb)->first();
                                        $ambienteDate = Carbon::parse($ambiente->fecha);
                                    @endphp

                                    @if ($ambienteDate >= $currentDate)
                                        <li>
                                            <span>Aula: {{ $nombre->nroAmb }}<br>
                                                Fecha: {{ $ambiente->fecha }}<br>
                                                Hora: {{ $ambiente->horaInicio }}<br>
                                                Estado: {{ $ambiente->estado }}
                                            </span>
                                            @if ($ambiente->estado == 'Proceso')
                                                <a href="{{ route('editarReserva', $ambiente->id) }}" class="editar-button" style="color:#ffff; font-weight: normal;">Modificar</a>
                                                <a href="{{ route('eliminarReserva', $ambiente->id) }}" class="cancel-button" style="color:#ffff; font-weight: normal;">Cancelar</a>
                                            @elseif ($ambiente->estado == 'Aceptado')
                                                <a href="{{ route('eliminarReserva', $ambiente->id) }}" class="cancel-button" style="color:#ffff; font-weight: normal;">Cancelar</a>
                                            @elseif ($ambiente->estado == 'Rechazado')
                                                
                                            @endif
                                        </li>
                                    @endif
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
            <p class="gris">Esta operación es irreversible</p>
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

@if(Session::has('success'))
<div id="successModal" class="modal" style="display: block; background-color: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
    <div class="modal-content" style="background-color: white; width: 50%; margin: 20% auto; padding: 20px; border-radius: 5px; text-align: center;">
        <p><strong>{{ Session::get('success') }}</strong></p>
        <div class="button-container">
            <button class="btnAceptar" style="background-color: #0B6F63; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="closeSuccessModal()">Aceptar</button>
        </div>
    </div>
</div>
@endif

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

    function openModal2(registroId) {
        document.getElementById('registro_id').value = registroId;
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal2() {
        document.getElementById('myModal').style.display = 'none';
    }

    document.getElementById('notificacionLink').addEventListener('click', function() {
        document.getElementById('contadorNotificaciones').textContent = '0';
    });

    function closeSuccessModal() {
        document.getElementById('successModal').style.display = 'none';
    }
</script>

</html>
