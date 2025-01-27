<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  href="{{ URL::asset('resources/css/dashboard.css') }}" >
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"/>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/ereader.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/log-out.css' rel='stylesheet'>
</head>

<body>

<header>
    <div id="title_GR">
        <div id="logo">
            <a href="{{ url('/') }}">
                <img id="GR" src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" width="40px" alt="">
            </a>
        </div>
    </div>

    <div id="headerAll">
        <div id="headerT">
            <button onclick="Finicio()" class="inicioI">Inicio</button>
            <button onclick="fCargarSolicitudes()" class="inicioI">Solicitudes</button>
            <button class="inicioI">Mensajes</button>
            <button class="inicioI">Visitas</button>
            <button onclick="Fpropiedad()" class="inicioI">Propiedades</button>
            <button class="inicioI">
               
                <a href="{{url('/logout') }}">Cerrar Sesion</a>
            </button>
        </div>
    </div>
    <div id="menu">
    <img src="{{URL ::asset('resources/menus.png') }}" alt="" >

    </div>
</header>
<!-- <h4>Publica tu alojamiento</h4>       
            -->

<section>
 <div id="contenedorDashboard">
    <div id="publicarResi">
    <h1>Bienvenido, {{ $nombreUsuario }}</h3>
    <br>
    <br>
    <br>
    <h5>Publica tu primer alojamiento</h5>
    <br>
    @if($residencias->count() < 0)
        <p>Todavia no tienes ningún anuncio activo. Publica tu primer alojamiento y empieza a recibir reservas</p>
    @else
        <p>¿Quieres añadir un nuevo alojamiento?.</p>
    @endif
    <br>
    <br>
    <a id="resButton" href="{{ url('add') }}">Añadir Residencia</a>
    <br>
    <br>
    <h5>Visualiza rápidamente tus solicitudes</h5>
    <br>
    <p>Realiza un seguimiento de las visualizaciones y de los leads interesados en tus alojamientos</p>
    <br>
    <br>
        
    <a id="resButton" onclick="fCargarSolicitudes()">Solicitudes</a>

    </div>


    <div id="contenedorImagen">
        <img src="{{ URL::asset('resources/dahsboardimg.jpg') }}" alt="">

    </div>
</div>
<div id="propiedadDash">
  
    <div id="columnaResis">
    <h1>Propiedades</h1>
    <br>
    <div id="scroll">
    @foreach($residencias as $residencia)
    
        <div id="cajaResis">
         
             <div id="contenidoResi">
                <h3>{{ $residencia->nombre_resi }}</h3>
                 <p>Realiza al instante cambios en las caracteristicas, descripciones e imágenes de tu anuncio.</p>
                 <p>Estado: {{ $residencia->estado }}</p>
                 <div class="editarResi">
                    <a href="{{ route('residencia.edit', ['id' => $residencia->id_resi]) }}">Editar</a>   
                 </div>
             </div>
                <div id="imgResi">
                <img src="{{ URL::asset('resources/dahsboardimg.jpg') }}" alt="">
                 </div>
            </div>
       
        <br>
        @endforeach
        <br>
        </div>
    </div>
<div id="propiedadImg">




<img src="{{ URL::asset('resources/propiedad.jpg') }}" alt="">
</div>

</div>

<div id="solicitudes">


<p>Vaya, aun no tienes solicitudes</p>



</div>

 
</section>


<script src="{{ URL::asset('resources/js/dashboard.js') }}"></script>
</body>
</html>