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