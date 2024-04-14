
@extends('layout/plantilla')
@section('contenido')
<link href="{{asset ('css/noti.css')}}" rel="stylesheet">

<div class="card">
  <div class="card-header">Notificación
    <span class="noti" onclick="closeNotification()">&times;</span>
    </div>
  <div class="card-content">
    Esta es una notificación de prueba.
  </div>
</div>
<div class="card">
  <div class="card-header">Notificación
    <span class="noti" onclick="closeNotification()">&times;</span>
    </div>
  <div class="card-content">
    Esta es una notificación de prueba.
  </div>
</div>
<div id="card1" class="card">
  <div class="card-header">Notificación
    <span class="noti" onclick="closeNotification()">&times;</span>
    </div>
  <div class="card-content">
    Esta es una notificación de prueba.
  </div>
</div>
<div id="card" class="card">
  <div class="card-header">Notificación
    <span class="noti" onclick="closeNotification()">&times;</span>
    </div>
  <div class="card-content">
    Esta es una notificación de prueba.
  </div>
</div>
<script>
  // Función para cerrar la notificación
  function closeNotification() {
   // var card = document.querySelector(".card");
    //card.style.display = "none";
    document.getElementById('card').style.display = 'none';
    
  }
  
  </script>


@endsection




