const rolSelect = document.getElementById("rol");
const materiaSelect = document.getElementById("materia");
const grupoInput = document.querySelector('input[name="grupo"]');
const asignacionesTabla = document.getElementById("asignacionesTabla");
const asignacionesBody = document.getElementById("asignacionesBody");

// Array para almacenar las asignaciones pendientes
let asignacionesPendientes = [];

function mostrarMateriasDocente() {
    if (rolSelect.value === "Docente") {
        materiasDocente.style.display = "block";
    } else {
        materiasDocente.style.display = "none";
    }
}

// Función para agregar una asignación a la tabla y al array de asignaciones pendientes
function agregarAsignacion() {
    const materiaOption = materiaSelect.options[materiaSelect.selectedIndex];
    const materiaId = materiaOption.getAttribute("data-id");
    const materiaNombre = materiaOption.textContent;
    const grupo = grupoInput.value.trim();

    // Validar que se haya seleccionado una materia y que el campo de grupo no esté vacío
    if (materiaId === "" || grupo === "") {
        return;
    }

    // Crear la fila de la tabla
    const fila = asignacionesBody.insertRow();
    fila.innerHTML = `
    <td>${materiaNombre}</td>
    <td>${grupo}</td>
    <td>
        <button type="button" style="background-color: #393e41;" onclick="editarAsignacion(this)">Editar</button>
        <button type="button" style="background-color: #0D7360;" onclick="eliminarAsignacion(this)">Eliminar</button>
    </td>
`;
    // Agregar atributo data-id con la ID de la materia a la primera celda de la fila
    fila.cells[0].setAttribute("data-id", materiaId);

    // Agregar la asignación al array de asignaciones pendientes
    asignacionesPendientes.push({
        materia: materiaId,
        grupo,
    });

    // Limpiar los campos del formulario
    grupoInput.value = "";
    materiaSelect.selectedIndex = 0;
    console.log(asignacionesPendientes);

    document.querySelector('input[name="asignaciones[]"]').value =
        JSON.stringify(asignacionesPendientes);
}

// Función para editar una asignación
function editarAsignacion(botonEditar) {
    const fila = botonEditar.parentElement.parentElement;
    const materiaId = fila.cells[0].getAttribute("data-id");
    console.log(materiaId);
    const materiaNombre = fila.cells[0].textContent;
    const grupo = fila.cells[1].textContent;

    // Seleccionar la materia en el select
    for (let i = 0; i < materiaSelect.options.length; i++) {
        if (materiaSelect.options[i].getAttribute("data-id") === materiaId) {
            materiaSelect.selectedIndex = i;
            break;
        }
    }

    // Llenar el campo de grupo con el valor de la fila
    grupoInput.value = grupo;

    // Eliminar la fila de la tabla
    fila.remove();

    // Remover la asignación del array de asignaciones pendientes
    asignacionesPendientes = asignacionesPendientes.filter(
        (asignacion) =>
            asignacion.materia !== materiaId || asignacion.grupo !== grupo
    );
    document.querySelector('input[name="asignaciones[]"]').value =
        JSON.stringify(asignacionesPendientes);
}

// Función para eliminar una asignación
function eliminarAsignacion(botonEliminar) {
    const fila = botonEliminar.parentElement.parentElement;
    const materiaId = fila.cells[0].getAttribute("data-id");
    const grupo = fila.cells[1].textContent;

    // Eliminar la fila de la tabla
    fila.remove();

    // Remover la asignación del array de asignaciones pendientes
    asignacionesPendientes = asignacionesPendientes.filter(
        (asignacion) =>
            asignacion.materia !== materiaId || asignacion.grupo !== grupo
    );
    document.querySelector('input[name="asignaciones[]"]').value =
        JSON.stringify(asignacionesPendientes);
}

function cancelar() {
    var confirmar = confirm(
        "Esta seguro que quiere descartar el registro actual?"
    );
    if (confirmar) {
        window.location.href = "/listaUsuarios";
    }
}

document.addEventListener('DOMContentLoaded', function() {
    mostrarMateriasDocente();
    function mostrarMateriasDocente() {
        let rol = document.getElementById("rol").value;
        let checkboxMateriasDocente = document.getElementById("checkboxMateriasDocente");
        let checkbox = document.getElementById("mostrarMateriasDocente");

        if (rol === "Docente") {
            checkboxMateriasDocente.style.display = "inline-block";
        } else {
            checkbox.checked = false;
            checkboxMateriasDocente.style.display = "none";
            materiasDocente.style.display = "none";
        }
    }
    document.getElementById("rol").addEventListener("change", mostrarMateriasDocente);

    asignacionesPendientes = JSON.parse(document.querySelector('input[name="asignaciones[]"]').value);
});