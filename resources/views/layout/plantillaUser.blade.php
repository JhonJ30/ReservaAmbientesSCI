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
    <div class="div1" id="div1">
        <img src="{{asset ('img/san simon.png')}}" class="logo" alt="...">
        <nav class="navMenu">
            <div class="menu">
                <ul>
                    <li><a href="/client" class="priHabilitado">Inicio</a></li>
                    <li><a href="/client/verAmbientes" class="priHabilitado2">Ver Ambientes</a></li>
                    <li><a href="/client/ayuda" class="ultimo">Ayuda</a></li>
                </ul>
                <ul>
                    <li class="sesion">
                        <a href="/" class='iniSesion'>Mi Cuenta</a>
                    </li>

                </ul>
            </div>
        </nav>

    </div>
    <div class="container">
        @yield('contenido')
    </div>
</body>

</html>