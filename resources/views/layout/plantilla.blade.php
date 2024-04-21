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
    <li> <a href="/" class="priHabilitadoInicio"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
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
        <p><a href="/listaA" class="priHabilitado2">&nbsp;&nbsp;Ambientes</a></p>
        <p><a href="/listaH" class="priHabilitado2">&nbsp;&nbsp;Horarios</a></p>
        <p><a href="/listaM" class="priHabilitado2">&nbsp;&nbsp;Materias</a></p>
        <p><a href="/listaU" class="priHabilitado2">&nbsp;&nbsp;Usuarios</a></p>
      </ul>
    </li>
    <li><a href="/noti" class="priHabilitado2" ><i class="fas fa-bell"></i>&nbsp;</a></li>
    <li><a href="#" class="ultimo" ><i class="fas fa-question-circle"></i>&nbsp;Ayuda</a></li>
    <li><a href="/client" class='iniSesion'><i class="fas fa-user"></i>Mi Cuenta</a></li>
  </ul>
</div>

<script>
  function toggleMenu() {
    const menu = document.querySelector('.menu');
    menu.classList.toggle('active');
  }

  document.addEventListener('DOMContentLoaded', function () {
  const menuRegistrar = document.getElementById('menuRegistrar');
  menuRegistrar.addEventListener('click', function (event) {
    event.preventDefault(); // Previene el comportamiento por defecto del enlace.
    const submenu = document.getElementById('submenuRegistrar');
    submenu.classList.toggle('active'); // Muestra u oculta el submenú.
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const menuRegistrar = document.getElementById('menuRegistrar2');
  menuRegistrar.addEventListener('click', function (event) {
    event.preventDefault(); // Previene el comportamiento por defecto del enlace.
    const submenu = document.getElementById('submenuRegistrar2');
    submenu.classList.toggle('active'); // Muestra u oculta el submenú.
  });
});
</script>
<div class="container">
    @yield('contenido')
</div>


</body>
</html>


