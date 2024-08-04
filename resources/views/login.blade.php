

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link rel="stylesheet"  href="{{ URL::asset('resources/css/login.css') }}" >
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
                <!-- Bootstrap CSS v5.2.1 -->
                <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        
        <style>

        </style>
</head>
<body>
    <div id="contenedor">
    <a href="{{ URL('/') }}">
        <img src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" >
    </a>
    <i>Inicia sesión para seguir navegando</i>


    <form action="{{ url('login') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="correo">Correo</label>
        <input type="email" required name="correo" id="correo" aria-describedby="helpId" placeholder="Correo"/>
        <label for="pass">Contraseña</label>
            <input type="password" required name="contraseña" id="pass" aria-describedby="helpId" placeholder="Contraseña"/> 
            @error('contraseña')
                <p style="color: red;">{{ $message }}</p>
            @enderror              
        <br>
        <div>
            <button type="submit">Iniciar Sesión</button>
        </div>
    </form>
        <div id="botonera">
            <a href="{{ url('register') }}">¿No tienes cuenta?<span style="color: #BA2344"> Crea una aquí</span></a>
        </div>
    </div>
    <img src="{{ URL::asset('resources/LOGIN.jpg') }}" alt="">
</div>
</body>
</html>