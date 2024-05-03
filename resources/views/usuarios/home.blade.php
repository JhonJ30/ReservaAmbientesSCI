@extends(Auth::check() ? 
    (Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' : 
    (Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' : 
    'layout.plantillaInvitado')) 
: 'layout.plantillaInvitado')

@section('contenido')
    <h1 class="aviso">AVISOS: </h1>

    <div class="avisos">
        <div class="comunicado">
            <img src="{{asset ('img/comunicado.png')}}">
        </div>
        <div class="tecno">
            <img src="{{asset ('img/tecno.png')}}">
        </div>
    </div>
@endsection