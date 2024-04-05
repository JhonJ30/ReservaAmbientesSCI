<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <li> <a href="/" class="priHabilitado"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
    <li><a href="#" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Registrar</a>
      <ul class="submenu">
        <p><a href="/registroAmb" class="priHabilitado2">&nbsp;&nbsp;Ambientes</a></p>
        <p><a href="/horarios" class="priHabilitado2">&nbsp;&nbsp;Horarios</a></p>
      </ul>
    </li>
    <li><a href="#" class="priHabilitado2"><i class="fas fa-eye"></i>&nbsp;Visualizar</a>
      <ul class="submenu">
        <p><a href="/listaA" class="priHabilitado2">&nbsp;&nbsp;Ambientes</a></p>
        <p><a href="/listaH" class="priHabilitado2">&nbsp;&nbsp;Horarios</a></p>
      </ul>
    </li>
    <li><a href="#" class="ultimo" ><i class="fas fa-question-circle"></i>&nbsp;Ayuda</a></li>
    <li><a href="/client" class='iniSesion'><i class="fas fa-user"></i>Mi Cuenta</a></li>
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


