@extends('layout/plantillaAdmin')

@section('contenido')
<link href="{{asset ('css/ambiente.css')}}" rel="stylesheet">
    <form action="{{ route('ambientes.update', $ambiente->id) }}" method="POST" onsubmit="return error()">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="registro">

        <div class="titulo-registro"> <h1>REGISTRO DE AMBIENTE</h1></div>
        <div class="contenido-registro">
        <div class="col1">
           <label>Unidad de Ambiente(*)</label>
           <select name="unidadAmb" required>
            <option value="" disabled selected hidden class="opcion-deshabilitada">----</option>
            <option value="Decanato" {{ $ambiente->unidadAmb == 'Decanato' ? 'selected' : '' }}>Decanato</option>
            <option value="Jefatura" {{ $ambiente->unidadAmb == 'Jefatura' ? 'selected' : '' }}>Jefatura</option>
            <option value="Departamento" {{ $ambiente->unidadAmb == 'Departamento' ? 'selected' : '' }}>Departamento</option>
           </select>

           <label >Ubicación del Ambiente(*)</label>
           <textarea name="ubicacion" placeholder="Ej: Edificio nuevo segundo piso." maxlength="100" style="border: 1px solid black;" oninput="validarInput2(this)"
           class="textarea1" required>{{ $ambiente->ubicacion }}</textarea>
           <div class="texto-error-advertencia" id="error-message2" style="color: red; display: none;"></div>


           <label>Capacidad del Ambiente(*)</label>
           <input name="capacidad" type="text" placeholder="Ej: 150" required value="{{ $ambiente->capacidad }}"
           id="capacidad" maxlength="3" oninput="validarInput(this)" style="border: 1px solid black;">
           <div class="texto-error-advertencia" id="error-message" style="color: red; display: none;"></div>
        
        </div>
        <div class="col2">
            <label>Tipo de Ambiente(*)</label>
            <select name="tipoAmb" id="tipoAmb" required>
                <option value="" disabled selected hidden>----</option>
                <option value="Aula" {{ $ambiente->tipoAmb == 'Aula' ? 'selected' : '' }}>Aula</option>
                <option value="Laboratorio" {{ $ambiente->tipoAmb == 'Laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                <option value="Auditorio" {{ $ambiente->tipoAmb == 'Auditorio' ? 'selected' : '' }}>Auditorio</option>
                <option value="Taller" {{ $ambiente->tipoAmb == 'Taller' ? 'selected' : '' }}>Taller</option>
            </select>
            <label>Equipamiento(*)</label>
            
            <div class="radiosButtons">
            @php
// Suponiendo que $ambiente->equipamiento contiene algo como "Proyector,Pizarras"
// Convertimos esa cadena en un array
$equipamientoSeleccionado = explode(',', $ambiente->equipamiento);
@endphp

<input type="checkbox" name="equipamiento[]" value="Proyector" {{ in_array('Proyector', $equipamientoSeleccionado) ? 'checked' : '' }}>
<label>Proyector</label>
<br>
<input type="checkbox" name="equipamiento[]" value="Pizarras" {{ in_array('Pizarras', $equipamientoSeleccionado) ? 'checked' : '' }}>
<label>Pizarras</label>
<br>
<input type="checkbox" name="equipamiento[]" value="Otros" {{ in_array('Otros', $equipamientoSeleccionado) ? 'checked' : '' }}>
<label>Otros</label>

            </div>

            <label >Estado del Ambiente(*)</label>
            <select name="estado" id="" required>
                <option value="" disabled selected hidden>----</option>
                <option value="Disponible" {{ $ambiente->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="No Disponible" {{ $ambiente->estado == 'No Disponible' ? 'selected' : '' }}>No Disponible</option>
                <option value="Reservado" {{ $ambiente->estado == 'Reservado' ? 'selected' : '' }}>Reservado</option>
            </select>
        </div>

        <div class="col3">
            <label>Número o Nombre <br> del Ambiente(*) </label>
            <input type="text" placeholder="Ej: 690B"  name="nroAmb" maxlength="5" required value="{{ $ambiente->nroAmb }}">
            <div class="texto-error-advertencia" id="error-message4" style="color: red; display: none;"></div>
            
            <label>Descripción(*)</label>
            <textarea name="descripcion" placeholder="Ej: Aula común ubicado en el edificio nuevo, en el segundo piso de tamaño 75 a 100 m²."
             class="textarea2" maxlength="150" style="border: 1px solid black;" oninput="validarInput3(this)" required>{{ $ambiente->descripcion }}</textarea>
            <div class="texto-error-advertencia" id="error-message3" style="color: red; display: none;"></div>

        </div>

        </div>
        <div class="botones">
            
            <a href="/listaAmbientes" >
            <button class="cancelar-btn" type="button" onclick=" ">Cancelar</button>
           <!-- <button class="botonCancelar" onclick=" ">Cancelar</button>-->
             </a> 
              
            <button class="botonRegistrar" type="submit">Editar</button>
        </div>
    </div>
</form>

<script>
    function cancelar(){
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
    };

    document.getElementById('tipoAmb').addEventListener('change', function() {
        var selectedOption = this.value;
        var nroAmbInput = document.getElementsByName('nroAmb')[0];
        var errorMessage = document.getElementById("error-message4");

        // Cambiar el placeholder dependiendo del tipo de ambiente seleccionado
        switch(selectedOption) {
            case 'Aula':
                nroAmbInput.placeholder = 'Ej: 690B';
                break;
            case 'Laboratorio':
                nroAmbInput.placeholder = 'Ej: Labo1';
                break;
            case 'Auditorio':
                nroAmbInput.placeholder = 'Ej: Audi';
                break;
            case 'Taller':
                nroAmbInput.placeholder = 'Ej: Tall1';
                break;
            default:
                nroAmbInput.placeholder = 'Ej: 690B';
                break;
        }

        nroAmbInput.addEventListener('input', function() {
        var inputValue = this.value.trim();

        if (inputValue === '') {
            showError("No puede estar vacío");
        } else {
            switch(selectedOption) {
                case 'Aula':
                    // Solo se admiten 3 números seguidos de una letra
                    if (!/^\d{3}[a-zA-Z]?$/.test(inputValue)) {
                        showError("Error en formato. Ej: 691 o 691A");
                    } else {
                        hideError();
                    }
                    break;
                case 'Laboratorio':
                    // Solo se admiten 4 letras seguidas de un número
                    if (!/^[a-zA-Z]{4}\d$/.test(inputValue)) {
                        showError("Error en formato. Ej: Labo1");
                    } else {
                        hideError();
                    }
                    break;
                case 'Auditorio':
                    // Solo se admiten 3 letras
                    if (!/^[a-zA-Z]{4}$/.test(inputValue)) {
                        showError("Error en formato. Ej: Audi");
                    } else {
                        hideError();
                    }
                    break;
                case 'Taller':
                    // Solo se admiten 4 letras seguidas de un número
                    if (!/^[a-zA-Z]{4}\d$/.test(inputValue)) {
                        showError("Error en formato. Ej: Tall1");
                    } else {
                        hideError();
                    }
                    break;
                default:
                    hideError();
                    break;
            }
        }
    });

    function showError(message) {
        nroAmbInput.style.borderColor = "red";
        errorMessage.style.display = "block";
        errorMessage.innerText = message;
    }

    function hideError() {
        nroAmbInput.style.borderColor = "black";
        errorMessage.style.display = "none";
    }
    });


    
    // Selecciona el campo de entrada
    function validarInput(input) {
  const onlyLettersAndSpacesRegex = /^\d+$/;
  
  if (input.value.trim() === '') {
    input.style.borderColor = "red";
    document.getElementById("error-message").style.display = "block";
    document.getElementById("error-message").innerText = "No puede estar vacío";
  } else if (!onlyLettersAndSpacesRegex.test(input.value)) {
    input.style.borderColor = "red";
    document.getElementById("error-message").style.display = "block";
    document.getElementById("error-message").innerText = "Solo admite números";
  } else {
    input.style.borderColor = "black";
    document.getElementById("error-message").style.display = "none";
  }
}

function validarInput2(input) {
  const onlyLettersAndSpacesRegex = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ.]+$/;
  
  if (input.value.trim() === '') {
    input.style.borderColor = "red";
    document.getElementById("error-message2").style.display = "block";
    document.getElementById("error-message2").innerText = "No puede estar vacío";
  } else if (!onlyLettersAndSpacesRegex.test(input.value)) {
    input.style.borderColor = "red";
    document.getElementById("error-message2").style.display = "block";
    document.getElementById("error-message2").innerText = "No admite caracteres especiales";
  } else {
    input.style.borderColor = "black";
    document.getElementById("error-message2").style.display = "none";
  }
}

function validarInput3(input) {
  const onlyLettersAndSpacesRegex = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ.]+$/;
  
  if (input.value.trim() === '') {
    input.style.borderColor = "red";
    document.getElementById("error-message3").style.display = "block";
    document.getElementById("error-message3").innerText = "No puede estar vacío";
  } else if (!onlyLettersAndSpacesRegex.test(input.value)) {
    input.style.borderColor = "red";
    document.getElementById("error-message3").style.display = "block";
    document.getElementById("error-message3").innerText = "No admite caracteres especiales";
  } else {
    input.style.borderColor = "black";
    document.getElementById("error-message3").style.display = "none";
  }
}

function error() {
   

    var mensajeError = document.getElementById("error-message");
    var mensajeError2 = document.getElementById("error-message2"); 
    var mensajeError3 = document.getElementById("error-message3");  
    var mensajeError4 = document.getElementById("error-message4");

    if (mensajeError.style.display === "block" || mensajeError2.style.display === "block" || mensajeError3.style.display === "block"
        || mensajeError4.style.display === "block") {
        return false;
    } else {
        return true;
    }
    return true;
   }
</script>
@endsection