
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
                <!-- Bootstrap CSS v5.2.1 -->
                <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet"  href="{{ URL::asset('resources/css/registerR.css') }}" >
</head>

<body>
<aside></aside>
<nav></nav>
<section>
    <div id="contenedor">
        <a href="{{ url('/') }}">
        <img src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" alt="">
        </a>
        <i>Registra tu residencia</i>
        <form action="{{ url('addResi') }}" method="post" enctype="multipart/form-data">
            @csrf
        <label for="nombre_resi" >Nombre del alojamiento</label>
            <input type="text" required name="nombre_resi" id="nombre_resi"/>
            <label for="ubicacion">Calle completa</label>
            <input type="text" required name="ubicacion" id="ubicacion"/>
            <label for="nombre_ciu">Provincia</label>
            <input type="text" required name="nombre_ciu" id="nombre_ciu"/>
            <label for="URL">URL</label>
            <input type="text" required name="URL" id="URL"/>
            <label for="contenido" >Descripción</label>
            <textarea name="contenido" id="contenido" cols="128" rows="5"></textarea>   
            <div id="options" >
                <button type="submit" >Continuar</button>
                <button><a type="button" id="bck" href="{{ url('dashboard') }}" >Atrás</a></button>
            </div>
        </form>
        
    </div>
</section>

</body>
</html>

