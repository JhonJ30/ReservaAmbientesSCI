<link href="{{asset ('css/search.css')}}" rel="stylesheet">

<div class="searchBox">
    <input class="search" type="text" name="search" spellcheck="false" placeholder="no Aula, Descripción">
    <div class="icon">
        <button class="iconButton"  onclick="openModal()">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="">
        <button class="iconButton" onclick="openModal()">
            <i class="fas fa-sliders"></i>
        </button>
    </div>
</div>

<dialog class="modal" id="mainModal">
    <div class="contentSearch">
        <div class="filter">
            <label>Fecha: </label>
            <input class="date" type="date">

            <label style="margin-left: 10%; width:5%;">Hora: </label>
            <input class="time" type="time">
        </div>

        <div class="filter">
            <label>Recursos: </label>
            <div class="selectResource" style="margin-left: 2%;">
                <div class="resource">
                    <input type="checkbox" id="resource1" value="Proyector">
                    <label for="resource1">Proyector</label>
                </div>
                <div class="resource">
                    <input type="checkbox" id="resource2" value="Proyector">
                    <label for="resource2">Pizarra</label>
                </div>
                <div class="resource">
                    <input type="checkbox" id="resource3" value="Computadora">
                    <label for="resource3">WiFi</label>
                </div>
            </div>
        </div>


        <div class="filter">
            <label>Capacidad: </label>
            <input class="minValue" type="number" min="0" max="200" placeholder="min">
            <input class="maxValue" type="number" min="0" max="200" placeholder="max">
        </div>
    </div>

    <button class="cancelButton" onclick="closeModal()">Cancelar</button>
    <button class="searchButton" onclick="closeModal()">Buscar</button>
</dialog>

<script src="{{asset ('js/search.js')}}"></script>