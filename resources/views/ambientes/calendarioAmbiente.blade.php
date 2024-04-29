@extends(Auth::check() && Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' : 'layout.plantillaInvitado')

@section('contenido')
    <h1 class="aviso" style="text-align:center; margin: 0 auto; margin-top: 30px;">{{ $nroAula }}: CALENDARIO</h1>
@endsection