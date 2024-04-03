<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset ('css/home.css')}}" rel="stylesheet">
   
   
   
    <script src="{{asset ('js/RH.js')}}"></script>

    <title>@yield('titulopagina')</title>
</head>
<body>
    <div class="div1" id="div1">
        <img src="{{asset ('img/san simon.png')}}" class="logo" alt="...">
        <nav class="navMenu">
            <div class="menu"> 
            <ul>
                <li>
                    <a href="/" class="priHabilitado"><i class="fas fa-home"></i>&nbsp;Inicio</a>
                </li>
                <li class="reserva-parent">
                    <a href="#" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Registrar</a>
                    <ul class="reserva-options">
                        <li><a href="/registroAmb" class="priHabilitado2">Ambientes</a></li>
                        <li><a href="/horarios" class="priHabilitado2">Horarios</a></li>
                    </ul>
                </li>
                <li class="reserva-parent">
                    <a href="#" class="priHabilitado2"><i class="fas fa-eye"></i>&nbsp;Visualizar</a>
                    <ul class="reserva-options">
                        <li><a href="/listaA" class="priHabilitado2">Ambientes</a></li>
                        <li><a href="/listaH" class="priHabilitado2">Horarios</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="ultimo" ><i class="fas fa-question-circle"></i>&nbsp;Ayuda</a>
                </li>
            </ul>
            <ul >
                <li class="sesion">
                    <a href="/client" class='iniSesion'><i class="fas fa-user"></i>&nbsp;Mi Cuenta</a>
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