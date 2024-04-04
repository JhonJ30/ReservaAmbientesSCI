<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!--<link href="{{asset ('css/home.css')}}" rel="stylesheet">-->
<title>@yield('titulopagina')</title>
</head>
<style>
   body {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
  font-family: Arial, sans-serif;
  background-color: #E9F4F3;
}

.navbar {
    
    background-color: #b4b8bb;
  /*background-color: #333;*/
  color: #fff;
  
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
}

.logo a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
}

.menu-toggle {
  display: none;
  flex-direction: column;
  cursor: pointer;
}

.bar {
  width: 25px;
  height: 3px;
  background-color: #fff;
  margin: 3px 0;
}

.menu {
  display: flex;
  list-style-type: none;
  background-color: #ADADAD;
  align-items: center;
}

.menu li {
   
  margin-right: 20px;
  position: relative;
  
  /*background-color: #F0F0F0;
  background-color: #ADADAD;
    transition: background-color 0.3s;
    transition: color 0.3s;
    border-top-left-radius: 7px ;
    border-bottom-left-radius: 7px;*/
}

.menu li:last-child {
  margin-right: 0;
}

.menu a {
  text-decoration: none;
  color: #3d475b;
  font-weight: bold;
}

.submenu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #444;
  padding: 10px 0;
  background-color: #ADADAD;
}

.submenu li {
  margin-right: 0;
  margin-bottom: 5px;
}

.submenu a {
    color: #3d475b;
}
/*agregado*/

.priHabilitado{
    background-color: #ADADAD;
    color: #3d475b;
    display: flex;
    align-items: center;
    
    padding: 8px;
    border-radius: 7px;
    transition: background-color 0.3s;
    transition: color 0.3s;
    cursor: pointer; 
}

.priHabilitado2{
    background-color: #ADADAD;
    color: #3d475b;
    display: flex;
    align-items: center;
    padding: 8px;
    border-radius: 7px;
    transition: background-color 0.3s;
    transition: color 0.3s;
    cursor: pointer; 
}
.priHabilitado2:hover{
    color: #F5F6F7;
    background-color: #235298;
    
}
.priHabilitado:hover{
    color: #F5F6F7;
    background-color: #235298;
}
.iniSesion {
    display: flex;
    align-items: center;
    gap:2px;
    background-color: #F5F6F7;
    color: #3d475b;
    border-radius: 7px ;
    transition: background-color 0.3s;
    transition: color 0.3s;
    cursor: pointer;
}
.iniSesion i{
    background-color: #3d475b;
    color: #F5F6F7;
    padding: 8px;
    border-radius: 50%;
    transition: background-color 0.3s;
}

.iniSesion:hover{
    color: #F5F6F7;
    background-color: #235298;
}

.iniSesion:hover i{
    background-color: #f5f5f5;
    color: #ee316b;
}

.ultimo{
    background-color: #ADADAD;
    color: #3d475b;
    display: flex;
    align-items: center;
    padding: 8px;
    border-radius: 7px;
    transition: background-color 0.3s;
    transition: color 0.3s;
    cursor: pointer; 
}
.ultimo:hover{
    background-color: #235298;
    color: #F5F6F7;
}

.sesion{
    position: relative;
    left: 20px;
    color:black;
}
/*hasta aqui*/

.menu li:hover .submenu {
  display: block;
  
}



@media screen and (max-width: 768px) {
  .menu-toggle {
    display: flex;
  }

  .menu {
    display: none;
    flex-direction: column;
    background-color: #ADADAD;
    padding: 20px;
    position: absolute;
    top: 50px;
    left: 0;
    width: 100%;
  }

  .menu.active {
    display: flex;
  }

  .menu li {
    margin-right: 0;
    margin-bottom: 10px;
  }

  .menu a {
    color: #3d475b;
    font-weight: bold;
  }

  .submenu {
    display: none;
    position: static;
    background-color: #ADADAD;
    padding-left: 20px;
  }

  .submenu.active {
    display: block;
  }
  .avisos{
    flex-direction: column;
  }
  .comunicado img, .tecno img {
    max-width: 100%;
    height: auto;
    margin: 1px 0; /* Ajusta los márgenes para las imágenes */
  }
  .tecno img {
    margin-left: -4px !important; 
  }
  .aviso{
    text-align: center;
  }
}
.container {
    max-width: 100%;
    padding: 0 20px;
    margin: 0 auto;
    align-items: center;
}
/*hasta aqui*/
.aviso{
    font-size: 30px;
    margin-left: 2%;
    margin-top: 20px;
    font-family: sans-serif;
    color: #3d475b;
}
.comunicado img{
    width: 650px;
    height: 435px;
    margin-left: -1%;
    margin-top: 12px;
}
.avisos{
    display: flex;
}
.tecno img{
    width: 650px;
    height: 435px;
    margin-top: 12px;
    margin-left: 25px;
}


</style>
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


