<style>
    /*menu css*/
*{
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    vertical-align: baseline;
}
body{
    background-color: #E9F4F3;
}

.div1 {
    margin-bottom: 50px;/*separacion del titulo registro de horario*/
    background-color: #b4b8bb;
    justify-content: space-between;
    display: flex;
    align-items: center;
    font-family: sans-serif;
    height: 127px; /* Ajusta este valor según sea necesario */
}

.logo {
    width: 10px; /* Ajusta el ancho del logo según sea necesario */
    margin-right: 650px; /* Ajusta el margen derecho para separar el logo del menú */
    margin-left: auto; /* Esto centrará el logo horizontalmente dentro de su contenedor */
    width: 180px;
}


.menu {
    
    display: flex;
    line-height: 1.9285714286;
    text-decoration: none;
    font-weight: 700;
    padding-right: 1rem;
    align-items: center;
    font-size: 16px;
    transform: translateX(-80px);
    
}

li a {
    text-decoration: none;
    font-weight: bold;
    text-align: center;
    padding: 6px 22px;
    border: 2px solid transparent;
    /*transition: border-color 0.3s, color 0.3s;*/
    /*border-radius: 5px;*/
    background-color: #F0F0F0;
    color: #969696;
}


ul {
    display: flex;
    width: 100%;
    height: 30%;
    margin: 0;
    padding: 0;
    text-align: right;
    list-style-type: none;
    white-space: nowrap;
    align-items: center;
    margin-left: 15px;
}

li{
    display: inline-flex;
    height: 100%;
    align-items: center;
}

.priHabilitado{
    background-color: #F0F0F0;
    color: #3d475b;
    border-top-left-radius: 7px ;
    border-bottom-left-radius: 7px;
    transition: background-color 0.3s;
    transition: color 0.3s;
}

.priHabilitado2{
    background-color: #ADADAD;
    color: #3d475b;
    
    transition: background-color 0.3s;
    transition: color 0.3s;
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
    gap: 10px;
    background-color: #0B6F63;
    color: #F5F6F7;
    border-radius: 7px ;
    transition: background-color 0.3s;
    transition: color 0.3s;
    cursor: pointer;
    padding-left: 35px; /* Ajusta este valor según sea necesario para mover el texto más a la izquierda */
}

.iniSesion::after {
    content: ''; /* Contenido del pseudo-elemento, en este caso, una imagen */
    background-image: url('usuario-de-perfil.png'); /* Ruta de la imagen */
    background-size: cover; /* Ajusta el tamaño de la imagen para cubrir completamente el área */
    background-repeat: no-repeat; /* Evitar la repetición de la imagen */
    width: 25px; /* Ancho de la imagen */
    height: 25px; /* Altura de la imagen */
    margin-right: 5px; /* Espacio entre la imagen y el texto */
}


.iniSesion.seleccionado {
    border-bottom-right-radius: 0; 
    border-bottom-left-radius: 0; 
    background-color: #d3d7df;
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
    border-top-right-radius: 7px ;
    border-bottom-right-radius: 7px; 
    background-color: #ADADAD;
    color: #3d475b;
}
.ultimo:hover{
    background-color: #235298;
    color: #F5F6F7;
}

.sesion{
    position: relative;
    left: 20px;
}

/*Detecta cambio de ancho*/
@media (max-width: 1098px) {
    .navMenu{
        overflow-x: auto;
    }
    .sesion{
        position: static;
    }

    .div1{
        position: relative;
    }
}
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
    margin-left: 2%;
    margin-top: 12px;
}
.avisos{
    display: flex;
}
.tecno img{
    width: 650px;
    height: 435px;
    margin-top: 12px;
    margin-left: 37px;
}

/* CSS*/
.reserva-options {
    display: none;
    position: absolute;
    /*background-color: #ffffff;*/
    /*border: 1px solid #cccccc;*/
    padding: 15px;
    z-index: 1;
    /* Ajustes para posicionar correctamente */
    top: 100%; /* Se colocará debajo del elemento padre */
    left: -30px; /* Se alineará con el borde izquierdo del elemento padre */
    margin-top: -15px;
}

.reserva-options li {
    display: block; /* Mostrar los elementos en una columna */
    margin-bottom: 24px; /* Espacio entre elementos */
    
}
.reserva-options li a {
    display: block; /* Convertir los enlaces en bloques para que ocupen todo el ancho */
    width: 100px; /* Ancho fijo para los enlaces */
    text-align: center; /* Centrar el texto horizontalmente */
    padding: 8px; /* Ajustar el relleno */
}


.reserva-parent {
    position: relative; /* Ajuste para que .reserva-options esté relativo a este elemento */
}

.reserva-parent:hover .reserva-options {
    display: block;
}

.reserva-options {
    display: none;
    position: absolute;
    padding: 15px;
    z-index: 1;
    top: 100%;
    left: -30px;
    margin-top: -15px;
}

.reserva-options li {
    display: block;
    margin-bottom: 24px;
}

.reserva-options li a {
    display: block;
    width: 100px;
    text-align: center;
    padding: 8px;
}

.reserva-parent {
    position: relative;
}

.reserva-parent:hover .reserva-options {
    display: block;
}

/*hasta aqui menu*/

/* Estilos para el contenedor del formulario :) */
#form-container {
    margin-bottom: 20px;/* Ajusta los márgenes para reducir el tamaño del contenedor */
    padding: 20px;
    background-color: #9ca2a6ef; /*color del cuadro*/
    background-color: #ADADAD; /*borde del cuadro*/
    max-width: 1200px; /* Establece un ancho máximo para el contenedor*/
    max-width: 1000px; /* Ajusta este valor según el tamaño deseado */
    margin-left: auto; /* Centra el contenedor horizontalmente*/
    margin-right: auto;
    border-radius: 10px; /*curvea el cuadro*/
}
/* Estilos para las etiquetas */
label {
    display: block;
    margin-bottom: 10px;
    font-family: sans-serif;
    color: #0B6F63;
}
label::after {
    content: "(*)";
    color: #0B6F63;
  }

/* Estilos para los campos de entrada */
input[type="time"],
input[type="text"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

/* Estilos para el botón */
button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

/*button:hover {
    background-color: #0056b3;
}*/
h1{/*Registro de horario*/
    font-size: 38px;/*agranda la letra*/
    margin-bottom: 30px; /* Añade un margen inferior al título(abajo) */
    /*margin-left: 100px; /* Ajusta para mover el título más a la derecha */
    text-align: center;
    font-family: sans-serif;
    color: #0B6F63;
}

.form-row {
    display: flex;
    margin-bottom: 50px;/*espacio de altura*/
}

.form-column {
    flex: 1;
    margin-right: 100px; /* Añade un margen a la derecha para separar los elementos(ANCHO) */
}

.form-column:last-child {
    margin-right: 0; /* No se necesita margen a la derecha para el último elemento de la fila */
}
#intervalo {
    width: 50%; /* Puedes ajustar el valor según tus necesidades */
}
/* Estilos de los botones cancelar y registrar */
.button-container {
    display: flex;
    justify-content: center; /* Centra los elementos horizontalmente */
    margin-top: 20px; /* Agrega un margen superior */
}

.button-container button {
    margin: 0 90px; /* Agrega un margen horizontal entre los botones */
}
.cancelar-btn {
    background-color: #ccc; /* Color plomito */
    color: white; /* Color del texto */
    padding: 10px 50px; /* Ajusta el tamaño del botón */
    border: 1px solid #999; /* Añade un borde */
    border-radius: 5px; /* Redondea las esquinas */
    cursor: pointer;
    background-color: #393E41;
}

.Editar-btn {
    background-color: #0B6F63; /* Color verde */
    color: white; /* Color del texto */
    padding: 10px 50px;
    border: 1px solid #0B6F63;
    border-radius: 5px;
    cursor: pointer;
    background-color: #0B6F63;
}
.cancelar-btn:hover{
    background-color: #ee316b;
    transition: 0.5s;
}
.Editar-btn:hover{
    background-color: #17ae74;
    transition: 0.5s;
}
</style>

@extends('layout/plantilla')
@section('contenido')
<!--hasta aqui menu-->

<link href="{{asset ('css/RH.css')}}" rel="stylesheet">
<h1>REGISTRO DE HORARIOS</h1>
<form action="{{ route('horarios.update', ['id' => $horario->id]) }}" method="POST" id="formulario"><!--CAMBIOS SS-->
@csrf
@method('PUT')
<body onload="toggleIntervalo()"> <!-- Aquí agregamos el evento onload -->
    @yield('contenido') <!-- Esto es donde se incluirá el contenido específico de cada página -->
    <!-- El resto de tu contenido HTML, como el menú, formularios, etc. -->
</body>
<div id="form-container">
    <div class="form-row">
        <div class="form-column">
            <label for="tipo-ambiente">Tipo de Ambiente:</label>
            <select name="tipoAmbiente" id="tipo-ambiente" onchange="toggleIntervalo()" required>
                <option value="" disabled selected hidden>----</option>
                <option value="aula" {{ $horario->tipoAmbiente == 'aula' ? 'selected' : '' }}>Aula</option>
                <option value="laboratorio" {{ $horario->tipoAmbiente == 'laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                <option value="auditorio" {{ $horario->tipoAmbiente == 'auditorio' ? 'selected' : '' }}>Auditorio</option>
                <option value="taller" {{ $horario->tipoAmbiente == 'taller' ? 'selected' : '' }}>Taller</option>
            </select>
        </div>
        <div class="form-column">
            <label for="ambiente">Ambiente:</label>
            <select name="ambi" required>
                <option value="" disabled selected hidden>----</option>
                <option value="690B" {{ $horario->ambi == '690B' ? 'selected' : '' }}>690B</option>
                <option value="Lab1" {{ $horario->ambi == 'Lab1' ? 'selected' : '' }}>Lab1</option>
            </select>
        </div>
    </div>
    <!-- nuevo comentario-->
    <div class="form-row">
        <div class="form-column">
            <label for="hora-inicio">Hora de Inicio:</label>
            <input name="horaInicio" type="time" id="hora-inicio"  onchange="calcularHoraFin()" required min="06:45" max="21:45" value="{{ $horario->horaInicio }}">
           <!-- <input name="horaInicio" type="time" id="hora-inicio" value="{{ $horario->horaInicio }}">-->
        </div>
        <div class="form-column">
            <label for="hora-fin">Hora de Fin:</label>
           <input name="horaFin" type="time" id="hora-fin" required min="06:45" max="21:45" value="{{ $horario->horaFin }}">
           <!-- <input name="horaFin" type="time" id="hora-fin" value="{{ $horario->horaFin }}">-->
        </div>
    </div>
    <div class="form-column"  id="intervalo-label">
        <label for="intervalo">Intervalo (si es necesario):</label>
        <input type="text" id="intervalo" onchange="calcularHoraFin()" placeholder="Ingrese el rango de intervalo">

    </div>
    <div class="button-container">
        <button class="cancelar-btn" type="button" onclick="cancelarRegistro()">Cancelar</button>
        <button class="Editar-btn" type="submit">Guardar Cambios</button>
    </div>
</form>
</div>

@endsection
<script>
    // metodo para hacer desaparecer el intervalo si selecciona auditorio o taller

function toggleIntervalo() {
    var tipoAmbiente = document.getElementById('tipo-ambiente').value;
    var intervaloInput = document.getElementById('intervalo'); // Obtener el elemento del intervalo
    var intervaloLabel = document.getElementById('intervalo-label'); // Obtener el elemento de la etiqueta del intervalo
    // Verificar el tipo de ambiente seleccionado
    if (tipoAmbiente === 'auditorio' || tipoAmbiente === 'taller') {
        intervaloInput.style.display = 'none'; // Ocultar el campo de intervalo
        intervaloLabel.style.display = 'none'; // Ocultar la etiqueta del intervalo
    } else {
        intervaloInput.style.display = 'block'; // Mostrar el campo de intervalo
        intervaloLabel.style.display = 'block'; // Mostrar la etiqueta del intervalo
    }
}
// RH.js

// Función para calcular y actualizar la hora de fin de forma :) automáticamente
function calcularHoraFin() {
    var tipoAmbiente = document.getElementById('tipo-ambiente').value;
    var horaInicio = document.getElementById('hora-inicio').value;
    var intervalo = parseInt(document.getElementById('intervalo').value, 10); // Convertir a entero

    if (tipoAmbiente === 'aula' || tipoAmbiente === 'laboratorio') {
        // Verificar si se ingresaron valores validos para hora de inicio y intervalo
        if (horaInicio && !isNaN(intervalo) && intervalo > 0) {
            // Separar la hora de inicio en horas y minutos
            var [horaInicioHoras, horaInicioMinutos] = horaInicio.split(':').map(Number);
            
            // Convertir la hora de inicio a minutos
            var horaInicioTotalMinutos = horaInicioHoras * 60 + horaInicioMinutos;

            // realiza el calculo de la suma de hora inicio y intervalo
            var horaFinTotalMinutos = horaInicioTotalMinutos + intervalo;
            var horaFinHoras = Math.floor(horaFinTotalMinutos / 60);
            var horaFinMinutos = horaFinTotalMinutos % 60;

            // Formatear la hora de fin
            var horaFin = horaFinHoras.toString().padStart(2, '0') + ':' + horaFinMinutos.toString().padStart(2, '0');

            // acutaliza o calcula el valor de hora fin
            document.getElementById('hora-fin').value = horaFin;
        }
    }
}

// onchange sirve para controlar los intervalos o label
document.getElementById('hora-inicio').onchange = calcularHoraFin;
document.getElementById('intervalo').onchange = calcularHoraFin;

//boton cancelar
/*function cancelarRegistro(){
    var confirmar = confirm("Esta seguro que quiere descartar el registro actual?");
    if(confirmar){
        window.location.href = "/";
    }
}
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}
 // Esta función se llama cuando se carga la página para mostrar automáticamente el modal
 window.onload = function() {
    document.getElementById('myModal').style.display = 'block';
};*/
function cancelarRegistro() {
    document.getElementById("formulario").reset();
}
//modificar


</script>