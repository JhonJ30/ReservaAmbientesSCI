@extends(Auth::check() ?
(Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' :
(Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' :
'layout.plantillaInvitado'))
: 'layout.plantillaInvitado')

@section('contenido')
<link href="{{asset ('css/search.css')}}" rel="stylesheet">

<div>
    <div class="search-container">
        @include('components.search')
    </div>
    <br>
    <div>
        @if (!$ambientes->isEmpty())
        <div class="listClassroom">
            <table>
                <thead>
                    <tr>
                        <th>Nro Aula</th>
                        <th>Capacidad</th>
                        <th>Ubicación</th>
                        <th>Recursos</th>
                        <th>Calendario</th>
                        <th>Reservas</th> <!--cambios sara-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ambientes as $ambiente)
                    <tr>
                        <td>{{ $ambiente->nroAmb }}</td>
                        <td>{{ $ambiente->capacidad }}</td>
                        <td>{{ $ambiente->ubicacion }}</td>
                        <td>{{ $ambiente->equipamiento }}</td>
                        <td>
                            <button onclick="window.location.href='/calendario/{{ $ambiente->id }}'">
                                <i class="fas fa-calendar-days"></i>
                            </button>
                        </td>
                        <td>
                            @auth
                            <button onclick="window.location.href='{{ route('reservas.show', ['ambiente_id' => $ambiente->id, 'nro_ambiente' => $ambiente->nroAmb]) }}'">Reservar</button>
                            @else
                            <button onclick="window.location.href='{{ route('iniciarSesion') }}'">Reservar</button>
                            @endauth
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="text-align:left; margin-left: 5%; margin-top:20px">No se encontraron resultados</p>
        @endif
    </div>
</div>
@if(session('success'))
<div class="overlay">
    <div class="overlay-content">
        <p>{{ session('success') }}</p>
        <div class="button-container">
            <button id="closeButton">Aceptar</button>
        </div>
    </div>
</div>
@endif
<style>
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Asegura que esté por encima de otros elementos */
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 40px; /* Ajusta según necesites */
}
#closeButton {
    background-color: #0B6F63; /* Color de fondo del botón */
    color: white; /* Color del texto del botón */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s; /* Transición suave del cambio de color de fondo */
    font-size: 18px; 
}

#closeButton:hover {
    background-color: #17ae74; /* Color de fondo del botón al pasar el cursor */
}
.overlay-content {
    background-color: #ffffff;
    padding: 20px 100px; /* Ajusta el padding horizontal */
    margin: 0 auto; 
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    font-weight: bold;
    font-size: 18px; 
}
</style>
<script>
    document.getElementById('closeButton').addEventListener('click', function() {
        document.querySelector('.overlay').style.display = 'none';
    });
</script>
@endsection