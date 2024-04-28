
@extends('layout/plantillaDocente')
@section('contenido')
<link href="{{asset ('css/noti.css')}}" rel="stylesheet">

@foreach ($notificaciones as $item )
      <div class="card">
        <div class="card-header">Notificación

        <form action="{{ route('notificaciones.update', $item->idN) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-link"><span class="noti">X</span></button>
            </form>
         
        </div>
        <div class="card-content">
        La solicitud a su reserva del aula {{$item->codAmb}} en fecha {{$item->fecha}} 
        fue una  {{$item->mensaje}} 
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




