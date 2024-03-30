<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    vertical-align: baseline;
}
body{
    background-color: #E9F4F3;
    font-family: sans-serif;

}

.div1 {
    background-color: #b4b8bb;
    justify-content: space-between;
    display: flex;
    align-items: center;
    font-family: sans-serif;
}

.logo{
    margin: 30px;
    width: 175px;
    height: auto;
}


.menu {
    
    display: flex;
    line-height: 1.9285714286;
    text-decoration: none;
    font-weight: 700;
    padding-right: 1rem;
    align-items: center;
    font-size: 16px;
    transform: translateX(-80px);
    
}

li a {
    text-decoration: none;
    font-weight: bold;
    text-align: center;
    padding: 6px 22px;
    border: 2px solid transparent;
    /*transition: border-color 0.3s, color 0.3s;*/
    /*border-radius: 5px;*/
    background-color: #F0F0F0;
    color: #969696;
}


ul {
    display: flex;
    width: 100%;
    height: 30%;
    margin: 0;
    padding: 0;
    text-align: right;
    list-style-type: none;
    white-space: nowrap;
    align-items: center;
    margin-left: 15px;
}

li{
    display: inline-flex;
    height: 100%;
    align-items: center;
}

.priHabilitado{
    background-color: #F0F0F0;
    color: #3d475b;
    border-top-left-radius: 7px ;
    border-bottom-left-radius: 7px;
    transition: background-color 0.3s;
    transition: color 0.3s;
}

.priHabilitado2{
    background-color: #ADADAD;
    color: #3d475b;
    
    transition: background-color 0.3s;
    transition: color 0.3s;
}
.priHabilitado2:hover{
    color: #F5F6F7;
    background-color: #235298;
}
.priHabilitado:hover{
    color: #F5F6F7;
    background-color: #235298;
}

.iniSesion {
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #0B6F63;
    color: #F5F6F7;
    border-radius: 7px ;
    transition: background-color 0.3s;
    transition: color 0.3s;
    cursor: pointer;
    padding-left: 35px; /* Ajusta este valor según sea necesario para mover el texto más a la izquierda */
}

.iniSesion::after {
    content: ''; /* Contenido del pseudo-elemento, en este caso, una imagen */
    background-image: url('../usuario-de-perfil.png'); /* Ruta de la imagen */
    background-size: cover; /* Ajusta el tamaño de la imagen para cubrir completamente el área */
    background-repeat: no-repeat; /* Evitar la repetición de la imagen */
    width: 25px; /* Ancho de la imagen */
    height: 25px; /* Altura de la imagen */
    margin-right: 5px; /* Espacio entre la imagen y el texto */
}


.iniSesion.seleccionado {
    border-bottom-right-radius: 0; 
    border-bottom-left-radius: 0; 
    background-color: #d3d7df;
}


.iniSesion i{
    background-color: #3d475b;
    color: #F5F6F7;
    padding: 8px;
    border-radius: 50%;
    transition: background-color 0.3s;
}

.iniSesion:hover{
    color: #F5F6F7;
    background-color: #235298;
}

.iniSesion:hover i{
    background-color: #f5f5f5;
    color: #ee316b;
}

.ultimo{
    border-top-right-radius: 7px ;
    border-bottom-right-radius: 7px; 
    background-color: #ADADAD;
    color: #3d475b;
}
.ultimo:hover{
    background-color: #235298;
    color: #F5F6F7;
}

.sesion{
    position: relative;
    left: 20px;
}

/*Detecta cambio de ancho*/
@media (max-width: 1098px) {
    .navMenu{
        overflow-x: auto;
    }
    .sesion{
        position: static;
    }

    .div1{
        position: relative;
    }
}


/* CSS*/
.reserva-options {
    display: none;
    position: absolute;
    /*background-color: #ffffff;*/
    /*border: 1px solid #cccccc;*/
    padding: 15px;
    z-index: 1;
    /* Ajustes para posicionar correctamente */
    top: 100%; /* Se colocará debajo del elemento padre */
    left: -30px; /* Se alineará con el borde izquierdo del elemento padre */
    margin-top: -15px;
}

.reserva-options li {
    display: block; /* Mostrar los elementos en una columna */
    margin-bottom: 24px; /* Espacio entre elementos */
    
}
.reserva-options li a {
    display: block; /* Convertir los enlaces en bloques para que ocupen todo el ancho */
    width: 100px; /* Ancho fijo para los enlaces */
    text-align: center; /* Centrar el texto horizontalmente */
    padding: 8px; /* Ajustar el relleno */
}


.reserva-parent {
    position: relative; /* Ajuste para que .reserva-options esté relativo a este elemento */
}

.reserva-parent:hover .reserva-options {
    display: block;
}

.registro {
    width: 950px;
    height: auto; /* Ajusta según sea necesario para acomodar el contenido */
    position: absolute;
    left: 50%;
    top: 60%;
    transform: translate(-50%, -50%);
    background-color: #ADADAD;
    border: none;
    border-radius: 9px;
    display: flex;
    flex-direction: column; /* Alinea los hijos (columnas y botones) verticalmente */
    align-items: center; /* Centra los hijos horizontalmente */
    padding: 20px;
    gap: 20px; /* Espacio entre el contenido de registro y los botones */
}
.contenido-registro {
    display: flex;
    justify-content: center;
    width: 100%;
    gap: 20px; /* Espacio entre las columnas */
    margin-bottom: 20px;
}

.botones {
    width: 100%; /* Asegura que los botones ocupen todo el ancho disponible */
    display: flex;
    justify-content: center; /* Centra los botones horizontalmente */
    gap: 300px; /* Espacio entre los botones */
}
.botones button{
    width: 20%;
    height: 35px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: #FFFFFF;
    
}
.col1{
    margin-top: 85px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: -70px;
    
}
.col1 label, select,textarea,input{
    padding: 5px;
    margin: 5px;
    
}
.col2{
    margin-top: 85px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: 70px;
}
.col2 label, select,input{
    padding: 5px;
    margin: 5px;

}
.col3{
    margin-top: 70px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: 50px;
}
.col3 label, textarea,input{
    padding: 5px;
    margin: 5px;

}
.titulo-registro h1{
    font-size: 2.5em; 
    margin-bottom: -80px; 
    font-family: sans-serif;
    color: #0B6F63;
}

select {
    width: 140px; /* Ajusta este valor al ancho deseado */
    padding: 5px; /* Añade un poco de relleno para que sea más fácil de usar */
    margin: 5px 0; /* Asegura un poco de espacio alrededor de los elementos para evitar la superposición */
    background-color: #fff; /* Fondo blanco o cualquier otro color deseado */
    border: 1px solid black; /* Borde sutil, cambia según prefieras */
    border-radius: 8px; /* Bordes redondeados para un aspecto moderno */
    box-shadow: inset 0 1px 3px #ddd; /* Sombra interna sutil para dar profundidad */
    font-family: sans-serif; /* Asegura una fuente consistente */
    font-size: 1em; /* Tamaño de fuente estándar */
    
}
input[type="text"]{
    width: 140px; /* Ajusta el ancho según sea necesario */
    padding: 6px 10px; /* Añade un relleno para hacerlo más cómodo al escribir */
    margin: 5px 0; /* Espacio antes y después del input */
    border: 1px solid black; /* Borde sutil */
    border-radius: 8px; /* Bordes redondeados para un aspecto suave */
    box-sizing: border-box; /* Asegura que el padding no aumente el tamaño del input */
    background-color: #f8f8f8; /* Fondo ligeramente gris para los inputs */
    font-family: sans-serif; /* Asegura una fuente consistente */
    font-size: 1em; /* Tamaño de fuente adecuado */
    text-align: center;
}
.textarea1{
    width: 170px; /* Ajusta el ancho según sea necesario */
    padding: 11px 10px; /* Añade un relleno para hacerlo más cómodo al escribir */
    margin: 5px 0; /* Espacio antes y después del input */
    border: 1px solid black; /* Borde sutil */
    border-radius: 11px; /* Bordes redondeados para un aspecto suave */
    box-sizing: border-box; /* Asegura que el padding no aumente el tamaño del input */
    background-color: #f8f8f8; /* Fondo ligeramente gris para los inputs */
    font-family: sans-serif; /* Asegura una fuente consistente */
    font-size: 1em; /* Tamaño de fuente adecuado */
    resize: none;
    
}
.textarea2{
    width: 210px; /* Ajusta el ancho según sea necesario */
    height: 105px;
    padding: 10px 10px; /* Añade un relleno para hacerlo más cómodo al escribir */
    margin: 5px 0; /* Espacio antes y después del input */
    border: 1px solid black; /* Borde sutil */
    border-radius: 11px; /* Bordes redondeados para un aspecto suave */
    box-sizing: border-box; /* Asegura que el padding no aumente el tamaño del input */
    background-color: #f8f8f8; /* Fondo ligeramente gris para los inputs */
    font-family: sans-serif; /* Asegura una fuente consistente */
    font-size: 1em; /* Tamaño de fuente adecuado */
    resize: none;
    
}
label{
    color: #0B6F63;
    font-size: 16px;
}
.botonCancelar{
    background-color: #393E41;
}
.botonRegistrar{
    background-color: #0B6F63;
}
.botonCancelar:hover{
    background-color: #ee316b;
    transition: 0.5s;
}
.botonRegistrar:hover{
    background-color: #17ae74;
    transition: 0.5s;
}

/* Agregar reglas de CSS para hacer el diseño responsive */
@media (max-width: 768px) {
    .registro {
        width: 90%; /* Reducir el ancho del formulario en pantallas más pequeñas */
        padding: 10px; /* Ajustar el padding del formulario */
        margin-top: 280px; /* Aumentar el margen superior en pantallas más pequeñas */
        margin-bottom: 50px; /* Añadir un margen inferior para evitar que se superponga con el botón */
    }

    .contenido-registro {
        flex-direction: column; /* Colocar las columnas una debajo de la otra en pantallas más pequeñas */
    }

    .col1, .col2, .col3 {
        margin-left: 0; /* Eliminar el margen izquierdo en las columnas para que se alineen correctamente */
        text-align: center; /* Centrar el contenido de las columnas */
        width: 100%; /* Asegurar que las columnas ocupen todo el ancho disponible */
        margin-bottom: -90px; /* Agregar un margen inferior para separar las columnas */
    }
    .botones {
        flex-direction: column; /* Apilar los botones verticalmente */
        gap: 10px; /* Agregar espacio entre los botones */
        margin-top: 70px; /* Ajustar el margen superior */
    }
    .botones button{
        width: 100%;
    }
    .titulo-registro{
        text-align: center;
    }
}



    </style>
</head>
<body>
    <div class="div1" id="div1">
        <img src="{{asset ('img/san simon.png')}}" class="logo" alt="...">
        <nav class="navMenu">
            <div class="menu">
            <ul>
                <li>
                    <a href="#" class="priHabilitado">Inicio</a>
                </li>
                <li class="reserva-parent">
                    <a href="#" class="priHabilitado2">Registrar</a>
                    <ul class="reserva-options">
                        <li><a href="#" class="priHabilitado2">Ambientes</a></li>
                        <li><a href="#" class="priHabilitado2">Horarios</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="priHabilitado2">Ver Ambientes</a>
                </li>
                <li>
                    <a href="#" class="ultimo" >Ayuda</a>
                </li>
            </ul>
            <ul >
                <li class="sesion">
                    <a href="../inicio_admin.html" class='iniSesion'>Mi Cuenta</a>
                </li>
            </ul>
            </div>
        </nav>
    
    </div>
    <form action="{{route('store')}}" method="POST">
    @csrf
    <div class="registro">

        <div class="titulo-registro"> <h1>REGISTRO DE AMBIENTE</h1></div>
        <div class="contenido-registro">
        <div class="col1">
           <label>Unidad de Ambiente(*)</label>
           <select name="unidadAmb" required>
            <option value="" disabled selected hidden class="opcion-deshabilitada">----</option>
            <option value="Decanato" >Decanato</option>
            <option value="Jefatura" >Jefatura</option>
            <option value="Departamento" >Departamento</option>
           </select>

           <label >Ubicación del Ambiente(*)</label>
           <textarea name="ubicacion" placeholder="Ej: Edificio nuevo segundo piso." class="textarea1" required></textarea>
           
           <label>Capacidad del Ambiente(*)</label>
           <input name="capacidad" type="text" placeholder="Ej: 150" required>
        </div>
        <div class="col2">
            <label>Tipo de Ambiente(*)</label>
            <select name="tipoAmb" id="" required>
                <option value="" disabled selected hidden>----</option>
                <option value="Aula">Aula</option>
                <option value="Laboratorio">Laboratorio</option>
                <option value="Auditorio">Auditorio</option>
                <option value="Taller">Taller</option>
            </select>
            <label>Equipamiento(*)</label>
            
            <div class="radiosButtons">
                <input type="radio" name="equipamiento" value="Proyector">
                <label >Proyector</label>
                <br>
                <input type="radio" name="equipamiento" value="Pizarras">
                <label>Pizarras</label>
                <br>
                <input type="radio" name="equipamiento" value="Otros">
                <label>Otros</label>
            </div>

            <label >Estado del Ambiente(*)</label>
            <select name="estado" id="" required>
                <option value="" disabled selected hidden>----</option>
                <option value="Disponible">Disponible</option>
                <option value="No Disponible">No Disponible</option>
                <option value="Reservado">Reservado</option>
            </select>
        </div>

        <div class="col3">
            <label>Número o Nombre <br> del Ambiente(*) </label>
            <input type="text" placeholder="Ej: 690B"  name="nroAmb" required>
            <label>Descripción(*)</label>
            <textarea name="descripcion" placeholder="Ej: Aula común ubicado en el edificio nuevo, en el segundo piso de tamaño 75 a 100 m²." class="textarea2" required></textarea>
        </div>

        </div>
        <div class="botones">
            <button class="botonCancelar" onclick="cancelar()">Cancelar</button>
            <button class="botonRegistrar" type="submit">Registrar</button>
        </div>
    </div>
</form>

<script>
    function cancelar(){
        var confirmar = confirm("Esta seguro que quiere descartar el registro actual?");
        if(confirmar){
            window.location.href = "/";
        }
    }
</script>
</body>
</html>