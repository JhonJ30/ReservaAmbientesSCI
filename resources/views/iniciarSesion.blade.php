<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset ('css/sesion.css')}}" rel="stylesheet">
    <title>@yield('titulopagina')</title>
</head>

<body>
    <h1>INICIAR SESIÓN</h1>
    <form action="{{route('login')}}" method="POST" onsubmit="return error()">
        @csrf
        <select name="rol" required>
            <option value="Administrador">Administrador</option>
            <option value="Docente">Docente</option>
            <option value="Auxiliar">Auxiliar</option>
        </select>

        <div class="form-column">
            <label for="email">Correo electrónico: </label>
            <input name="email" , type="email" required>
        </div>

        <div class="form-column">
            <label for="password" , style="margin-right: 67px;">Contraseña: </label>
            <input name="password" , type="password" required>
        </div>

        <button class="buttonLogin" type="submit">INGRESAR</button>
    </form>
</body>

</html>