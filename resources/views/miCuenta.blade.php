<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link rel="stylesheet"  href="{{ URL::asset('resources/css/miCuenta.css') }}" >
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <header>
        <div>
        <a href="{{ URL('/') }}">
            <img id="logo_header" src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" alt="">
        </a>
        </div>

        <div id="header-botonera">
            <div>Publica tu Residencia<p><ion-icon name="home"></ion-icon></p>
            </div>
            </div>
        </div>
    </header>
    <section>
        <div id="contenido">
            <h2 id="miCuenta">Mi cuenta</h2>
            <br>
            <form class="formMiCuenta" method="POST" action="{{ route('actualizarUsuario') }}">
                @csrf 
                <input type="text" name="nombre" id="nombre" value="{{ $usuario->nombre }}">
                <input type="text" name="apellidos" id="apellidos" value="{{ $usuario->apellidos }}">
                <p>Este es el nombre de la persona que usa esta cuenta (tú). 
                    Este nombre no se utilizará en las reservas: te pediremos el nombre del huésped una vez que reserves una habitación.</p>
                <br>
                <input type="text" name="correo" id="correo" value="{{ $usuario->correo }}">
                <p>Este correo electrónico se utilizará para enviarle notificaciones sobre sus reservas.</p>
                <br>
                <input type="text" name="telefono" id="telefono" value="{{ $usuario->telefono }}">
                <p>Este número de teléfono se utilizará para enviarle notificaciones sobre sus reservas.</p>
                <br>
                <button type="submit" class="boton">Guardar cambios</button>
            </form>

        </div>
    </section>
    <footer>
        <div id="contenedor-footer">
            <div id="footer-info">
                <div>
                    <h3>Sobre nosotros</h3>
                    <p>Blog</p>
                    <p>Cookies</p>
                    <p>Politica de privacidad</p>
                    <p>Términos de uso</p>
                </div>
                <div>
                    <h3>Buscador</h3>
                    <p>Colaboradores</p>
                    <p>Universidades</p>
                    <p>Ciudades</p>
                    <p>Contacto</p>
                </div>
                <div>
                    <h3>Ciudades más visitadas</h3>
                    <p>Residencias en Madrid</p>
                    <p>Residencias en Barcelona</p>
                    <p>Residencias en Granada</p>
                    <p>Residencias en Sevilla</p>
                </div>
            </div>
            <div id="contactanos">
                <img src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}" alt="">
                <h2>¿Necesitas ayuda?</h2>
                <p>Contacta con nuestro equipo</p>
                <button>CONTACTAR</button>
            </div>
        </div>
        <button id="boton-publicar">Publica tu residencia</button>
    </footer>
    <script src="{{ URL::asset('resources/js/miCuenta.js') }}"></script>
</body>
</html>