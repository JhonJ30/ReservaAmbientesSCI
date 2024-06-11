@extends(Auth::check() ?
(Auth::user()->rol === 'Docente' ? 'layout.plantillaDocente' :
(Auth::user()->rol === 'Administrador' ? 'layout.plantillaAdmin' :
'layout.plantillaInvitado'))
: 'layout.plantillaInvitado')

<style>
    .ayuda {
        font-family: Arial, sans-serif;
        background-color: #E9F4F3;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        height: 70vh;
    }

    h1 {
        margin-bottom: 20px;
        color:#0B6F63;
    }

    .containerAyuda {
        width: 40%;
        background-color: #fff;
        padding: 30px;
        text-align: left;
        border-radius: 20px;
    }

    section {
        margin-bottom: 20px;
    }

    section h2 {
        color: #555;
        padding: 0px;
        margin: 0px;
    }

    .containerAyuda ul {
        list-style: none;
        padding: 0;
    }

    .containerAyuda ul li {
        margin: 10px 0;
    }

    .containerAyuda ul li strong {
        color: #333;
    }

    a {
        color: #0066cc;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

@section('contenido')
<div class="ayuda">
    <h1>CENTRO DE AYUDA</h1>
    <p>¡No te quedes con dudas, contáctanos!
    ¡Nos encantaría ayudarte!</p>
    <div class="containerAyuda">
        <section>
            <h2>Contactos</h2>
            <ul>
                <li><strong>Teléfono:</strong> +591 71493582</li>
                <li><strong>Correo Electrónico:</strong> <a href="mailto:smartcodeinnovations@gmail.com">smartcodeinnovations@gmail.com</a></li>
                <li><strong>Dirección:</strong> Cochabamba, Bolivia</li>
            </ul>
        </section>
    </div>
</div>
@endsection