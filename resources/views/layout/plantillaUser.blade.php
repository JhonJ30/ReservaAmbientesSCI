<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css>
    <link href="{{asset ('css/home.css')}}" rel="stylesheet">
    <title>@yield('titulopagina')</title>
</head>
<!--menu usuario-->
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
                <li> <a href="/client" class="priHabilitado"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
                <li><a href="/client/verAmbientes" class="priHabilitado2"><i class="fas fa-eye"></i>&nbsp;Visualizar</a></li>
                <li><a href="/client/ayuda" class="ultimo" ><i class="fas fa-question-circle"></i>&nbsp;Ayuda</a></li>
                <li><a href="/" class='iniSesion'><i class="fas fa-user"></i>Mi Cuenta</a></li>
            </ul>
    </div>
    <div class="container">
        @yield('contenido')
    </div>
    <script>
        function toggleMenu() {
            const menu = document.querySelector('.menu');
            menu.classList.toggle('active');
        }
        </script>
</body>

</html>