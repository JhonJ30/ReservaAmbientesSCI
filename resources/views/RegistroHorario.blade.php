<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset ('css/listaH.css')}}" rel="stylesheet">

    <title>Inicio</title>
</head>
<body>
    <div class="div1" id="div1">
        <img src="{{asset ('img/san simon.png')}}" class="logo" alt="...">
        <nav class="navMenu">
            <div class="menu"> 
            <ul>
                <li>
                    <a href="#" class="priHabilitado">Inicio</a>
                </li>
                <li class="reserva-parent">
                    <a href="Registrar_Horario/Horarios.html" class="priHabilitado2">Registrar</a>
                    <ul class="reserva-options">
                        <li><a href="#" class="priHabilitado2">Ambientes</a></li>
                        <li><a href="Registrar_Horario/Horarios.html" class="priHabilitado2">Horarios</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="priHabilitado2">Ver Ambientes</a>
                </li>
                <li>
                    <a href="#" class="ultimo" >Ayuda</a>
                </li>
            </ul>
            <ul >
                <li class="sesion">
                    <a href="inicio_admin.html" class='iniSesion'>Mi Cuenta</a>
                </li>
            </ul>
            </div>
        </nav>
    
    </div>
    
</body>
</html>