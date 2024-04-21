@extends('layout/plantilla')
@section('contenido')


<!--ver lista de ambientes registrados -->
<link href="{{asset ('css/listaA.css')}}" rel="stylesheet">
<br>
<h2>Lista de Reservas</h2>
<br>
<div> 
<table>
  <thead>
    <tr>
      <th style="text-align: center;">Fecha</th>
      <th style="text-align: center;">Hora</th>
      <th style="text-align: center;">Ambiente</th>
      <th style="text-align: center;">Usuario</th>
      <th style="text-align: center;">Actividad</th>
      <th style="text-align: center;">Accion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;">15/04/2024</td>
      <td style="text-align: center;">12:45</td>
      <td style="text-align: center;">690B</td>
      <td style="text-align: center;">Ing. Leticia</td>
      <td style="text-align: center;">Pasar clases</td>
      <td style="text-align: center;">
      <button class="edit-btn" >Aceptar</button>
        <button  class="delete-btn"  >Rechazar</button>
      </td>
    </tr>
    <tr>
      <td style="text-align: center;">15/04/2024</td>
      <td style="text-align: center;">12:45</td>
      <td style="text-align: center;">690B</td>
      <td style="text-align: center;">Ing. Leticia</td>
      <td style="text-align: center;">Pasar clases</td>
      <td style="text-align: center;">
      <button class="edit-btn" >Aceptar</button>
        <button  class="delete-btn"  >Rechazar</button>
      </td>
    </tr>
    <tr>
      <td style="text-align: center;">15/04/2024</td>
      <td style="text-align: center;">12:45</td>
      <td style="text-align: center;">690B</td>
      <td style="text-align: center;">Ing. Leticia</td>
      <td style="text-align: center;">Pasar clases</td>
      <td style="text-align: center;">
      <button class="edit-btn" >Aceptar</button>
        <button  class="delete-btn"  >Rechazar</button>
      </td>
    </tr>
  </tbody>
</table>
</div>
@endsection