<style>
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
    margin: 0 30px; /* Agrega un margen horizontal entre los botones */
    padding: 10px 50px; /* Ancho relativo */
    border: 1px solid #999;
    border-radius: 5px;
    cursor: pointer;   
}
button.cancelar-btn {
    background-color: #393E41;
    color: white;
    padding: 10px 20px; /* Ancho relativo */
    border: 1px solid #999;
    border-radius: 5px;
    cursor: pointer;
}

/* Estilos específicos para pantallas más pequeñas*/
@media screen and (max-width: 600px) {
    .button-container {
        flex-direction: column; /* Cambia la dirección de los botones a vertical */
        align-items: center; /* Centra los botones verticalmente */
        text-align: center;
    }

    .button-container button {
        margin: 10px 0; /* Ajusta el margen superior e inferior */
        width: 80%; /* Ajusta el ancho de los botones */
        font-size: 16px; /* Tamaño de la fuente */
        padding: 15px 135px; /* Ajusta el relleno */
    }
    BUTTON.cancelar-btn {
        width: 80%; /* Botón ocupa el 80% del ancho disponible en pantallas pequeñas */
        min-width: unset; /* Eliminar el ancho mínimo */
        margin: 10px auto; /* Centra el botón */
    }
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

@extends('layout/plantillaAdmin')

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
            <select name="tipoAmbiente" id="tipo-ambiente" onchange="toggleIntervalo()" required disabled>
                <option value="" disabled selected hidden>----</option>
                <option value="aula" {{ $horario->tipoAmbiente == 'aula' ? 'selected' : '' }}>Aula</option>
                <option value="laboratorio" {{ $horario->tipoAmbiente == 'laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                <option value="auditorio" {{ $horario->tipoAmbiente == 'auditorio' ? 'selected' : '' }}>Auditorio</option>
                <option value="taller" {{ $horario->tipoAmbiente == 'taller' ? 'selected' : '' }}>Taller</option>
            </select>
        </div>
        <div class="form-column">
            <label for="ambiente">Ambiente:</label>
            <select name="ambi" required disabled>
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
    <a href="/listaHorarios">
        <button class="cancelar-btn" type="button" onclick=" ">Cancelar</button>
    </a>    
        <button class="Editar-btn" type="submit">Editar</button>
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