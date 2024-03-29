<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset ('css/home.css')}}" rel="stylesheet">
    <link href="{{asset ('css/listaA.css')}}" rel="stylesheet">

    <title>Inicio</title>
</head>
<body>
    <div class="div1" id="div1">
        <img src="{{asset ('img/san simon.png')}}" class="logo" alt="...">
        <nav class="navMenu">
            <div class="menu"> 
            <ul>
                <li>
                    <a href="/" class="priHabilitado">Inicio</a>
                </li>
                <li class="reserva-parent">
                    <a href="Registrar_Horario/Horarios.html" class="priHabilitado2">Registrar</a>
                    <ul class="reserva-options">
                        <li><a href="#" class="priHabilitado2">Ambientes</a></li>
                        <li><a href="/horarios" class="priHabilitado2">Horarios</a></li>
                    </ul>
                </li>
                <li class="reserva-parent">
                     <a href="Registrar_Horario/Horarios.html" class="priHabilitado2">Visualizar</a>
                    <ul class="reserva-options">
                        <li><a href="/listaA" class="priHabilitado2">Ambientes</a></li>
                        <li><a href="#" class="priHabilitado2">Horarios</a></li>
                    </ul>
                   
                </li>
                <li>
                    <a href="/inicio" class="ultimo" >Ayuda</a>
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

<!--ver lista de ambientes registrados -->
<br>
<br>
<h2>Lista de Ambientes</h2>
<br>
<div class="search-container">
  <input type="text" placeholder="Buscar..." class="search-input">
  <button class="search-button"><i class="fas fa-search"></i></button>
</div>
<br>
<div> 

<table>
  <thead>
    <tr>
      <th>Nro</th>
      <th>capacidad</th>
      <th>Ubicacion</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Juan</td>
      <td>25</td>
      <td>Madrid</td>
      <td>
      <button class="edit-btn" onclick="alert('Editar entrada 2')">Modificar</button>
        <button class="delete-btn" onclick="alert('Eliminar entrada 2')">Eliminar</button>
      </td>
      
    </tr>
    <tr>
      <td>2</td>
      <td>Maria</td>
      <td>30</td>
      <td>Barcelona</td>
      <td><button class="edit-btn" onclick="alert('Editar entrada 2')">Modificar</button>
        <button class="delete-btn" onclick="alert('Eliminar entrada 2')">Eliminar</button></td>
    </tr>
    <tr>
      <td>3</td>
      <td>Pablo</td>
      <td>28</td>
      <td>Sevilla</td>
      <td><button class="edit-btn" onclick="alert('Editar entrada 2')">Modificar</button>
        <button class="delete-btn" onclick="alert('Eliminar entrada 2')">Eliminar</button></td>
    </tr>
  </tbody>
</table>
</div>
    
</body>
</html>