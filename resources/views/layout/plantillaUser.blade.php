<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css>
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
  align-items: center;
}

.menu li {
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
  padding: 15px;
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
    border-radius:  7px 0 0 7px;
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
    border-radius:  0 7px 7px 0;
    transition: background-color 0.3s;
    transition: color 0.3s;
    cursor: pointer; 
    margin-right: 20px;
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

  .menu.active{
    display: flex;
    position: absolute;
    width: -webkit-fill-available;
    top: 90px;
    align-items: center;
  }

  .menu li {
    margin-right: 0;
    margin-bottom: 10px;
  }

  .menu a {
    color: #3d475b;
    font-weight: bold;
    padding: 8px;
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
    margin: 10px 0;
    margin-top: -3px !important;
  }
  .tecno img {
    margin-left: -4px !important; 
  }
  .aviso{
    text-align: center;
  }

  .ultimo{
    margin: 0;
  }

  .priHabilitado2:hover{
    background-color: transparent;

    }
.priHabilitado:hover{
    background-color: transparent;
    }

    .ultimo:hover{
    background-color: transparent;
    }

    .iniSesion:hover{
        background-color: transparent;
}

    .iniSesion{
        padding: 10px;
    }
}


.container {
    margin-top: 0px;
    max-width: 100%;
    padding: 0 20px;
    margin: 0 auto;
    align-items: center;
}
/*hasta aqui*/
.aviso{
    font-size: 30px;
    margin-left: 0.5%;
    margin-top: 15px;
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



/* otro*/
.container-reservas {
            width: 400px;
            margin: 50px auto;
            background-color: #FFFFFF;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative; 
            border-radius: 10px;
        }

.container-reservas h2 {
            text-align: start;
            margin-bottom: 20px;
        }
.container-reservas ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

.container-reservas  li {
            padding: 10px;
            background-color: #0B6F63;
            color: #FFFFFF;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cancel-button {
            background-color: #EE316B;
            color: #FFFFFF;
            border: none;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 15px;
            border-radius: 8px;
        }

        
        .editar-button {
            background-color: #3D475B;
            color: #FFFFFF;
            border: none;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 15px;
            border-radius: 8px;
        }

       

        .cancel-button2 {
            background-color: #D3D7DF;
            color: #3D475B;
            border: none;
            font-size: 16px;
            font-weight: bold;
            padding: 8px 0;
            width: 100%;
            cursor: pointer;
            text-align: left;
            padding-left: 24px;
            border-radius: 10px;
        }

        .cancel-button2 i {
            padding-left: 200px; /* Ajusta el espacio del icono */
        }

        .cancel-button2:hover {
            background-color: #EE316B;
            color: #FFFFFF;
        }

        .logo-reservas {
            position: absolute;
            top: 0;
            left: 0;
            width: 95.5%;
            height: 86px; /* Altura ajustable según tu preferencia */
            background-color: #B4B8BB; /* Color de fondo */
            display: flex;
            align-items: center;
            padding-left: 20px; /* Ajusta el espaciado izquierdo */
            text-align: center;
            border-radius: 10px;
        }

        .logo-reservas i {
            font-size: 64px; /* Tamaño del icono ajustable */
            margin-right: 25px; /* Espaciado entre el icono y el texto */
            margin-left: 20px;
            
        }

        .container-reservas h2 {
            margin-top: 80px; /* Ajusta el margen superior para compensar la altura de .logo */
            color: #3D475B;
        }

        .logo-reservas h2 {
            font-size: 28px; /* Ajusta el tamaño de la fuente según tu preferencia */
            margin-top: 0; /* Elimina el margen superior predeterminado */
            margin-bottom: 0; /* Elimina el margen inferior predeterminado */
            vertical-align: middle; /* Alinea verticalmente el texto con el icono */
            color: #3D475B;
        }

  .miCuentaContent {
    display: none;
    position: absolute;
    
}

.iniSesion:hover #miCuentaContent {
    display: block;
}

.container-reservas {
   margin-left: -290px;
   margin-top: 23px;
}

.icon-color {
    color: #3d475b; 
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
    <li> <a href="/client" class="priHabilitado"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
    <li><a href="/client/verAmbientes" class="priHabilitado2"><i class="fas fa-plus-circle"></i>&nbsp;Ver Ambientes</a>
    </li>
    <li><a href="/noti" class="priHabilitado2" ><i class="fas fa-bell"></i>&nbsp;<sup style="color: red;">2</sup></a></li>
    <li><a href="/client/ayuda" class="ultimo" ><i class="fas fa-question-circle"></i>&nbsp;Ayuda</a></li>
    <div onmouseover="showMiCuentaContent()" onmouseout="hideMiCuentaContent()">
   <li><a href="/" class='iniSesion'><i class="fas fa-user"></i>Mi Cuenta</a></li>
  <div id="miCuentaContent" class="miCuentaContent" style="display: none;">
    <div class="container-reservas">
    <div class="logo-reservas">
            <i class="fas fa-user-circle icon-color"></i>
            <h2>Usuario</h2>
        </div>
        <h2>Reservas</h2>
        <a href="/iniciarSesion" class="sesion-button"><i class="fas fa-question-circle"></i>Iniciar Sesión</a>
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
        <button class="cancel-button2">Cerrar Sesión 
            <i class="fas fa-right-from-bracket"></i>
        </button>
    </div>
  </div>
</div>
  </ul>
</div>
<div class="container">
    @yield('contenido')
</div>


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

function showMiCuentaContent() {
  document.getElementById("miCuentaContent").style.display = "block";
}

function hideMiCuentaContent() {
  document.getElementById("miCuentaContent").style.display = "none";
}
</script>

</body>
</html>