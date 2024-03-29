<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro de Horarios</title>
<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<script src="{{ asset('js/RH.js') }}"></script>
</head>
<body>
<!--menu-->
<body>
    <div class="div1" id="div1">
        <img src="{{asset ('img/san simon.png')}}" alt="..." class="logo">
        <nav class="navMenu">
            <div class="menu">
            <ul>
                <li>
                    <a href="/" class="priHabilitado">Inicio</a>
                </li>
                <li class="reserva-parent">
                    <a href="#" class="priHabilitado2">Registrar</a>
                    <ul class="reserva-options">
                        <li><a href="#" class="priHabilitado2">Ambientes</a></li>
                        <li><a href="#" class="priHabilitado2">Horarios</a></li>
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
<!--hasta aqui menu-->
<h1>Registro de Horarios</h1>

<div id="form-container">
    <div class="form-row">
        <div class="form-column">
            <label for="tipo-ambiente">Tipo de Ambiente:</label>
            <select id="tipo-ambiente" onchange="toggleIntervalo()">
                <option value="aula">Aula</option>
                <option value="laboratorio">Laboratorio</option>
                <option value="auditorio">Auditorio</option>
                <option value="taller">Taller</option>
            </select>
        </div>
        <div class="form-column">
            <label for="ambiente">Ambiente:</label>
            <select id="ambiente"></select>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-column">
            <label for="hora-inicio">Hora de Inicio:</label>
            <input type="time" id="hora-inicio"  onchange="calcularHoraFin()">
        </div>
        <div class="form-column">
            <label for="hora-fin">Hora de Fin:</label>
            <input type="time" id="hora-fin">
        </div>
    </div>
        <div class="form-column"  id="intervalo-label">
            <label for="intervalo">Intervalo (si es necesario):</label>
            <input type="text" id="intervalo" onchange="calcularHoraFin()">
        </div>
    <div class="button-container">
        <button class="cancelar-btn" onclick="cancelarRegistro()">Cancelar</button>
        <button class="registrar-btn" onclick="registrarHorario()">Registrar</button>
    </div>

</div>
<script src="RH.js"></script>
</body>
</html>