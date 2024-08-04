
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link rel="stylesheet"  href="{{ URL::asset('resources/css/register.css') }}" >
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
                <!-- Bootstrap CSS v5.2.1 -->
                <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
</head>
<body>

<div id="contenedor">
    <a href="{{ URL('/') }}">
        <img src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" >
    </a>
    <i>Rellena el formulario para iniciar sesión</i>
    <div id="botonera">
            <a type="button" href="{{ url('residencias') }}">¿Quieres publicar tu residencia?<span style="color: #BA2344"> Publicala aquí</span></a>
    </div>
    <form action="{{ url('register') }}" method="post" enctype="multipart/form-data">
            @csrf
                <label for="nombre">Nombre</label>
                <input type="text" required name="nombre" id="nombre" aria-describedby="helpId" placeholder=""/>
                <label for="apellidos">Apellidos</label>
                <input type="text" required name="apellidos" id="apellidos" aria-describedby="helpId" placeholder=""/>
                <label for="contraseña">Contraseña</label>
                <input type="password" required name="contraseña" id="contraseña" aria-describedby="helpId" placeholder=""/>
                <label for="confirmar_contraseña" class="form-label">Confirmar contraseña</label>
                <input type="password" required name="confirmar_contraseña" id="confirmar_contraseña" placeholder=""/>
                @if($errors->has('confirmar_contraseña'))
                    <p class="error-message">{{ $errors->first('confirmar_contraseña') }}</p>
                @endif
                <label for="correo">Correo</label>
                <input type="email" required name="correo" id="correo" aria-describedby="helpId" placeholder=""/>
                <label for="telefono">Teléfono</label>
                <input type="number" required name="telefono" id="telefono" aria-describedby="helpId" placeholder=""/>                
                <br>
                <div>
                    <button type="submit">Crear cuenta</button>
                </div>
        </form>


    </div>
    <img src="{{ URL::asset('resources/LOGIN.jpg') }}" alt="">
</div>

</body>
</html>