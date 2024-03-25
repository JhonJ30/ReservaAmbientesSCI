const modal = document.getElementById("mainModal");

const openModal = () =>{
    modal.showModal();
}

const closeModal = () => {
    modal.close();
}

function showSelector() {
    let selector = document.getElementById('selectResource');
    selector.classList.toggle('oculto');
}

function addResource() {
    let campoEntrada = document.getElementById('inputResource');
    let opcionesSeleccionadas = Array.from(document.getElementById('selectResource').selectedOptions).map(option => option.value);
    opcionesSeleccionadas.forEach(function(opcion) {
        campoEntrada.value += (campoEntrada.value ? ', ' : '') + opcion;
    });
    showSelector();
}