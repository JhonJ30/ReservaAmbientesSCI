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
    <h1>INGRESE A SU CUENTA</h1>
    <form action="{{route('login')}}" method="POST" onsubmit="return error()">
        @csrf
        <select name="rol" required>
            <option value="Administrador" {{ old('rol') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="Docente" {{ old('rol') == 'Docente' ? 'selected' : '' }}>Docente</option>
        </select>

        <div class="form-column">
            <label for="email">Correo electrónico: </label>
            <input name="email" type="email" value="{{ old('email') }}" required>
        </div>


        <div class="form-column">
            <label for="password" , style="margin-right: 67px;">Contraseña: </label>
            <input name="password" , type="password" required>
        </div>

        @if (session('errorMessage'))
            <p id="errorMessage">{{ session('errorMessage') }}</p>
        @endif


        <div class="button-container">
            <button class="buttonCancel" type="button" onclick="window.location.href='/'">CANCELAR</button>
            <button class="buttonLogin" type="submit">INICIAR SESIÓN</button>
        </div>
    </form>
</body>

<script>
    var errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
        setTimeout(function() {
            errorMessage.textContent = '';
        }, 3000);
    }
</script>

</html>