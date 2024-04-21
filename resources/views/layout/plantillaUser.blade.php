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
            <li> <a href="#" class="priHabilitado"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
            <li><a href="#" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Ver Ambientes</a>
            </li>
            <li><a href="#" class="ultimo"><i class="fas fa-question-circle"></i>&nbsp;Ayuda</a></li>
            <li><a href="/iniciarSesion"" class='iniSesion'><i class="fas fa-user"></i>&nbsp;Iniciar Sesión</a></li>
        </ul>
    </div>
    <div class="container">
        @yield('contenido')
    </div>
</body>

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
</script>

</html>