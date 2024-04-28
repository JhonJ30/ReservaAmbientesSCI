<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css>
    <link href="{{asset ('css/home.css')}}" rel="stylesheet">
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
            <li> <a href="/admin" class="priHabilitadoInicio"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
            <li><a href="#" id="menuRegistrar" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Registrar</a>
                <ul class="submenu" id="submenuRegistrar">
                    <p><a href="/registroAmb" class="priHabilitado2">&nbsp;&nbsp;Ambientes</a></p>
                    <p><a href="/horarios" class="priHabilitado2">&nbsp;&nbsp;Horarios</a></p>
                    <p><a href="/registroMateria" class="priHabilitado2">&nbsp;&nbsp;Materias</a></p>
                    <p><a href="/registroUsuario" class="priHabilitado2">&nbsp;&nbsp;Usuarios</a></p>
                </ul>
            </li>
            <li><a href="#" id="menuRegistrar2" class="priHabilitado2"><i class="fas fa-eye"></i>&nbsp;Visualizar</a>
                <ul class="submenu" id="submenuRegistrar2">
                    <p><a href="/listaR" class="priHabilitado2">&nbsp;&nbsp;Reservas</a></p>
                    <p><a href="/listaA" class="priHabilitado2">&nbsp;&nbsp;Ambientes</a></p>
                    <p><a href="/listaH" class="priHabilitado2">&nbsp;&nbsp;Horarios</a></p>
                    <p><a href="/listaM" class="priHabilitado2">&nbsp;&nbsp;Materias</a></p>
                    <p><a href="/listaU" class="priHabilitado2">&nbsp;&nbsp;Usuarios</a></p>
                </ul>
            </li>
            <li><a href="#" class="ultimo"><i class="fas fa-question-circle"></i>&nbsp;Ayuda</a></li>
            <div onmouseover="showMiCuentaContent()" onmouseout="hideMiCuentaContent()">
                <li><a href="#" class='iniSesion'><i class="fas fa-user"></i>Mi Cuenta</a></li>
                <div id="miCuentaContent" class="miCuentaContent" style="display: none;">
                    <div class="container-reservas">
                        <div class="logo-reservas">
                            <i class="fas fa-user-circle icon-color"></i>
                            <h2>{{ Auth::user()->apellido }} {{ Auth::user()->nombre }}</h2>
                        </div>
                        <h2>Reservas</h2>
                        <ul>
                            <li>
                                <span>Aula: 691A<br>
                                    Fecha: 26/05/2024<br>
                                    Hora: 15:45-17:15<br>
                                </span>
                                <button class="editar-button">Editar</button>
                                <button class="cancel-button">Cancelar</button>
                            </li>
                            <li>
                                <span>Aula: 691A<br>
                                    Fecha: 26/05/2024<br>
                                    Hora: 15:45-17:15<br>
                                </span>
                                <button class="editar-button">Editar</button>
                                <button class="cancel-button">Cancelar</button>
                            </li>
                            <li>
                                <span>Aula: 691A<br>
                                    Fecha: 26/05/2024<br>
                                    Hora: 15:45-17:15<br>
                                </span>
                                <button class="editar-button">Editar</button>
                                <button class="cancel-button">Cancelar</button>
                            </li>
                        </ul>
                        <button class="cancel-button2" id="cancel-button2">Cerrar Sesión
                            <i class="fas fa-right-from-bracket"></i>
                        </button>
                    </div>
                </div>
        </ul>
    </div>

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
    </script>
    <div class="container">
        @yield('contenido')
    </div>


</body>

</html>