<link href="{{asset ('css/search.css')}}" rel="stylesheet">

<form action="{{ route('ambientes.buscar') }}" method="GET">
    <div class="searchBox">
        <input class="search" type="text" name="search" spellcheck="false" placeholder="No Aula, Ubicación..." maxlength="50" pattern="[a-zA-Z0-9 ]+">
        <div class="icon">
            <button class="iconButton" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="icon">
            <button class="iconButton" type="button" onclick="openModal()">
                <i class="fas fa-sliders"></i>
            </button>
        </div>
    </div>
</form>

<dialog class="modalSearch" id="mainModal">
    <form action="{{ route('ambientes.buscarAvanzado') }}" method="GET">
        <div class="contentSearch">
            <div class="filter">
                <div class="filterDate">
                    <label>Fecha: </label>
                    <input class="date" type="date">
                </div>

                <div class="filterTime">
                    <label>Hora: </label>
                    <input class="time" type="time">
                </div>
            </div>

            <div class="filter">
                <label>Recursos: </label>
                <div class="selectResource" style="margin-left: 2%;">
                    <div class="resource">
                        <input type="checkbox" name="recursos[]" id="resource1" value="Proyector">
                        <label for="resource1">Proyector</label>
                    </div>
                    <div class="resource">
                        <input type="checkbox" name="recursos[]" id="resource2" value="Pizarra">
                        <label for="resource2">Pizarra</label>
                    </div>
                    <div class="resource">
                        <input type="checkbox" name="recursos[]" id="resource3" value="Otros">
                        <label for="resource3">Otros</label>
                    </div>
                    <!-- Agrega más checkboxes si es necesario -->
                </div>
            </div>
            <div class="filter">
                <label>Capacidad: </label>
                <div class=selectCapacity>
                    <input class="minValue" type="number" name="minValue" min="0" max="200" placeholder="min">
                    <input class="maxValue" type="number" name="maxValue" min="0" max="200" placeholder="max">
                </div>
            </div>
        </div>
        <div class="optionButton">
            <button class="cancelButton" type="button" onclick="closeModal()">Cancelar</button>
            <button class="searchButton" type="submit">Buscar</button>
        </div>
        </div>
    </form>
</dialog>
</form>

<script src="{{asset ('js/search.js')}}"></script>