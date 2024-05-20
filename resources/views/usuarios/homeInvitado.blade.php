@extends('layout.plantillaInvitado')
@php
$materias = App\Models\Materias::all();
$avisos= App\Models\aviso::where('estado', "Habilitado")->get();
@endphp
@section('contenido')
<style>
         /* Estilos específicos para la tabla */
         table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            /*text-align: center;*/
            color: white;
        }

        .columna-derecha {
            width: 30%;
            vertical-align: top;
            background-color:#235298; /* #b41415Ajusta la alineación vertical */
            /* #393E41 Añade el color de fondo */
        }

        .columna-izquierda {
            width: 70%;
            vertical-align: top;
        }

      /* Estilos para el carrusel */
      .carousel-container {
            position: relative;
            height: 500px; /* Ajusta la altura del carrusel según tus necesidades */
            overflow: hidden; /* Oculta el contenido que se desborda del carrusel */
        }

        .carousel-inner {
            position: relative;
            width: 100%; /* Asegura que el carrusel ocupe todo el espacio disponible */
            height: 100%;
            transition: transform 0.5s ease; /* Agrega una transición suave al cambiar las diapositivas */
            white-space: nowrap; /* Evita que las diapositivas se envuelvan */
        }

        .carousel-item {
            display: inline-block;
            width: 100%; /* Asegura que cada diapositiva ocupe todo el ancho del carrusel */
            height: 100%;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Botones de control del carrusel */
        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            z-index: 2;
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        .imagen-fija {
            position: absolute;
            top: 0px; /* Ajusta la posición vertical de la imagen fija */
            left: 0px; /* Ajusta la posición horizontal de la imagen fija */
            width: 100px; /* Ajusta el ancho de la imagen fija */
            height: auto;
            z-index: 1; /* Asegura que la imagen fija esté sobre el carrusel */
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
       
        .tarjeta {
            background-color: white;
            color: black;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.2;
        }

        .tarjeta-header {
            color: #B4B8BB;
            font-size: 12px; /* Puedes ajustar el tamaño de la fecha si es necesario */
            margin-bottom: 5px;
        }

        .tarjeta-body {
            text-align: center;
        }

             .fecha {
                text-align:left;
                color: #ee316b;
                display: block;/* Asegura que el texto ocupe toda la línea */
                 
            }
            .d-none {
                display: none;
            }

            #ver-mas-btn {
                display: block;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
            }

            #ver-mas-btn:hover {
                background-color: #0056b3;
            }
       

    </style>
    <br>
    <table >
    <tbody>
        <tr>
            <td class="columna-izquierda">
                 <!-- Carrusel de Bootstrap con imagen fija -->
                 <div class="carousel-container">
                    <img src="{{asset ('img/tecno1.png')}}" class="imagen-fija" alt="Imagen Fija">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item">
                                <img src="{{asset ('img/img2.jpg')}}" alt="Slide 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset ('img/img03.jpg')}}" alt="Slide 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset ('img/img01.jpg')}}" alt="Slide 3">
                            </div>
                        </div>
                        <button class="carousel-control carousel-control-prev" onclick="prevSlide()">‹</button>
                        <button class="carousel-control carousel-control-next" onclick="nextSlide()">›</button>
                    </div>
                </div>
            </td>
            <td class="columna-derecha">
            <h3 style="text-align: center;">Avisos</h3>
            <div id="avisos-container">
                    @foreach($avisos as $index => $dato)
                        <div class="tarjeta aviso @if($index >= 3) d-none @endif">
                            <div class="tarjeta-header">
                          <strong class="fecha"><i class="fas fa-thumbtack"></i> {{ $dato->fecInicio }} </strong>
                            </div>
                            <div class="tarjeta-body">
                                <strong>{{ $dato->titulo }}</strong><br>
                                {{ $dato->descripcion }}<br>
                                
                                @if ($dato->archivo !== 'sin_archivo')
                                    <a href="{{ route('descargar.archivo', $dato->archivo) }}">Descargar Archivo</a>
                                @else
                                    <strong>No hay archivo adjunto</strong>
                                @endif
                            </div>  
                        </div>
                        <hr class="aviso @if($index >= 3) d-none @endif">
                    @endforeach
                </div>
                 @if(count($avisos) > 3)
                    <button id="ver-mas-btn">Ver más</button>
                @endif
            <table >
                <tbody>
                    <tr >
                        <td style="padding:3px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15" height="15">
                        <path fill="#fff" d="M448 80v352c0 26.5-21.5 48-48 48h-85.3V302.8h60.6l8.7-67.6h-69.3V192c0-19.6 5.4-32.9 33.5-32.9H384V98.7c-6.2-.8-27.4-2.7-52.2-2.7-51.6 0-87 31.5-87 89.4v49.9H184v67.6h60.9V480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48z"></path>
                        </svg>
                        </td>
                        <td style="padding:3px; width:100%;">
                            <a href="https://www.facebook.com/UmssBolOficial/" target="new" style="font-size:13px; color:#fff;">Facebook UMSS</a>
                        </td>
                    </tr>    
                    <tr>
                        <td style="padding:3px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15" height="15">
                            <path fill="#fff" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-48.9 158.8c.2 2.8.2 5.7.2 8.5 0 86.7-66 186.6-186.6 186.6-37.2 0-71.7-10.8-100.7-29.4 5.3.6 10.4.8 15.8.8 30.7 0 58.9-10.4 81.4-28-28.8-.6-53-19.5-61.3-45.5 10.1 1.5 19.2 1.5 29.6-1.2-30-6.1-52.5-32.5-52.5-64.4v-.8c8.7 4.9 18.9 7.9 29.6 8.3a65.447 65.447 0 0 1-29.2-54.6c0-12.2 3.2-23.4 8.9-33.1 32.3 39.8 80.8 65.8 135.2 68.6-9.3-44.5 24-80.6 64-80.6 18.9 0 35.9 7.9 47.9 20.7 14.8-2.8 29-8.3 41.6-15.8-4.9 15.2-15.2 28-28.8 36.1 13.2-1.4 26-5.1 37.8-10.2-8.9 13.1-20.1 24.7-32.9 34z"></path>
                        </svg>

                      </td>
                        <td style="padding:3px;">
                            <a href="https://twitter.com/umssbolivia" target="new" style="font-size:13px; color:#fff;">Twitter UMSS</a>
                        </td>
                    </tr>    
                    <tr>
                        <td style="padding:3px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="15" height="15">
                            <path fill="#fff" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                        </svg>

                      </td>
                        <td style="padding:3px;">
                            <a href="https://www.youtube.com/user/CanalUmsstv" target="new" style="font-size:13px; color:#fff;">YouTube UMSS</a>
                        </td>
                    </tr>    
                    <tr>
                        <td style="padding:3px;">
                            <svg class="svg-inline--fa fa-blogger fa-w-14" style="color: #fff;font-size: 15px;" aria-hidden="true" data-prefix="fab" data-icon="blogger" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M162.4 196c4.8-4.9 6.2-5.1 36.4-5.1 27.2 0 28.1.1 32.1 2.1 5.8 2.9 8.3 7 8.3 13.6 0 5.9-2.4 10-7.6 13.4-2.8 1.8-4.5 1.9-31.1 2.1-16.4.1-29.5-.2-31.5-.8-10.3-2.9-14.1-17.7-6.6-25.3zm61.4 94.5c-53.9 0-55.8.2-60.2 4.1-3.5 3.1-5.7 9.4-5.1 13.9.7 4.7 4.8 10.1 9.2 12 2.2 1 14.1 1.7 56.3 1.2l47.9-.6 9.2-1.5c9-5.1 10.5-17.4 3.1-24.4-5.3-4.7-5-4.7-60.4-4.7zm223.4 130.1c-3.5 28.4-23 50.4-51.1 57.5-7.2 1.8-9.7 1.9-172.9 1.8-157.8 0-165.9-.1-172-1.8-8.4-2.2-15.6-5.5-22.3-10-5.6-3.8-13.9-11.8-17-16.4-3.8-5.6-8.2-15.3-10-22C.1 423 0 420.3 0 256.3 0 93.2 0 89.7 1.8 82.6 8.1 57.9 27.7 39 53 33.4c7.3-1.6 332.1-1.9 340-.3 21.2 4.3 37.9 17.1 47.6 36.4 7.7 15.3 7-1.5 7.3 180.6.2 115.8 0 164.5-.7 170.5zm-85.4-185.2c-1.1-5-4.2-9.6-7.7-11.5-1.1-.6-8-1.3-15.5-1.7-12.4-.6-13.8-.8-17.8-3.1-6.2-3.6-7.9-7.6-8-18.3 0-20.4-8.5-39.4-25.3-56.5-12-12.2-25.3-20.5-40.6-25.1-3.6-1.1-11.8-1.5-39.2-1.8-42.9-.5-52.5.4-67.1 6.2-27 10.7-46.3 33.4-53.4 62.4-1.3 5.4-1.6 14.2-1.9 64.3-.4 62.8 0 72.1 4 84.5 9.7 30.7 37.1 53.4 64.6 58.4 9.2 1.7 122.2 2.1 133.7.5 20.1-2.7 35.9-10.8 50.7-25.9 10.7-10.9 17.4-22.8 21.8-38.5 3.2-10.9 2.9-88.4 1.7-93.9z"></path></svg>
                        </td>
                        <td style="padding:3px;">
                            <a href="http://www.umss.edu.bo/index.php/blog/" target="new" style="font-size:13px;color:#fff;">Blog UMSS</a>
                        </td>
                    </tr>          
                </tbody>
            </table>

             </td>
        </table>
        <br>
        <br>
        <br>
<script>
    // Funciones para cambiar las diapositivas del carrusel
    let currentIndex = 0;
    const slides = document.querySelectorAll('.carousel-item');

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = slides.length - 1;
        }
        updateCarousel();
    }

    function nextSlide() {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateCarousel();
    }

    function updateCarousel() {
        const carouselInner = document.querySelector('.carousel-inner');
        carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
    /*ver mas*/
    document.addEventListener('DOMContentLoaded', function () {
        const verMasBtn = document.getElementById('ver-mas-btn');
        if (verMasBtn) {
            verMasBtn.addEventListener('click', function () {
                const avisos = document.querySelectorAll('.aviso.d-none');
                avisos.forEach(function (aviso) {
                    aviso.classList.remove('d-none');
                });
                verMasBtn.style.display = 'none';
            });
        }
    });
</script>

@endsection