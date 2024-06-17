@extends(Auth::check() ? 
    (Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' : 
    (Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' : 
    'layout.plantillaInvitado')) 
: 'layout.plantillaInvitado')


@section('contenido')
<link href="{{asset ('css/noti.css')}}" rel="stylesheet">

@foreach ($notificaciones as $item )
        @php
            $messageClass = $item->mensaje == 'Reserva aceptada' ? 'success' : 'error';
        @endphp

        <div class="card">
            <div class="card-header {{ $messageClass }}">
                <i class="fas fa-bell"></i> Notificación

                <form action="{{ route('notificaciones.update', $item->idN) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="noti">X</button>
                </form>
            </div>
            <div class="card-content">
                La solicitud a su reserva del aula {{ $item->codAmb }} en fecha {{ $item->fecha }}
                fue una <strong>{{ $item->mensaje }}</strong>
            </div>
        </div>
  @endforeach



<script>
  // Función para cerrar la notificación
  function closeNotification() {
   // var card = document.querySelector(".card");
    //card.style.display = "none";
    document.getElementById('card').style.display = 'none';
    
  }
  
  </script>


@endsection