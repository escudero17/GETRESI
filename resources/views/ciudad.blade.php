<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET RESI</title>
    <link rel="stylesheet" href="{{ URL::asset('resources/css/ciudad.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
</head>

<body >
<header>
    <div>
        <a href="{{ url('/') }}">
            <img id="logo_header" src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" alt="">
        </a>
    </div>
    <div id="contenedor-input">
        <form action="{{route('findByName')}}" method="POST">
            @csrf
            <input id="input-buscador" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Encuentra tu ciudad" type="text">
            <button type="submit" id="boton-buscar-ciudades"  ><ion-icon name="arrow-forward-circle"></ion-icon></button>
        </form>
    </div>
    <div id="header-botonera">
        
        @if($perfil === 1)
            <div><a type="button" href="{{ url('admindashboard') }}" class="btn btn-danger"> Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon></a></div>
            <div><a type="button" href="{{ url('miCuenta') }}" class="btn btn-danger">Mi Cuenta<ion-icon name="person-circle" id="user"></ion-icon></a></div>
        @elseif($perfil === 2)
            <div><a type="button" href="{{ url('dashboard') }}" class="btn btn-danger">Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon> </a></div>
            <div><a type="button" href="{{ url('miCuenta') }}" class="btn btn-danger">Mi Cuenta<ion-icon name="person-circle" id="user"></ion-icon></a></div>
        @elseif($perfil === 3)
            <div><a type="button" href="{{ url('dashboard') }}" class="btn btn-danger"> Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon></a></div>
            <div><a type="button" href="{{ url('miCuenta') }}" class="btn btn-danger">Mi Cuenta<ion-icon name="person-circle" id="user"></ion-icon></a></div>
        @else
        <div><a type="button" href="{{ url('login') }}" class="btn btn-danger">Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon> </a></div>
        <div><a type="button" href="{{ url('login') }}" class="btn btn-danger">Mi Cuenta<ion-icon name="person-circle" id="user"></ion-icon></a></div>
        @endif

          
           
        </div>
</header>
<nav>
<form id="filtroForm" action="{{ route('filtResi') }}" method="POST">   
        @csrf
        <div id="containerF">
            @foreach($categorias as $categoria)
                @if($categoria->id_cat_resi != 6 && $categoria->id_cat_resi != 5)
                    <div class="categoria" data-id="{{ $categoria->id_cat_resi }}">
                        <p>{{ $categoria->nombre_cat }} <ion-icon name='chevron-down-outline'></ion-icon></p>
                        <div class="info" style="display: none;">
                            <!-- Aquí se imprimirán las características asociadas a esta categoría -->
                            @foreach($caracteristicasresi as $caract)
                                @if($caract->id_cat_resi == $categoria->id_cat_resi)
                                    <div>
                                    <input type="checkbox" name="caracteristica{{ $caract->id_caracteristica }}" value="{{ $caract->id_caracteristica }}">
                                        <label>{{ $caract->nombre_carac }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            <button id="buscarBt" type="submit">Aplicar</button>
        </div>

   </form>
   
</nav>

<section>
<div id="contenedor-section">
        <div id="contenedor-buscador">
            <h1>DESCUBRE LOS <span>PREMIOS</span> AL REALIZAR <br>
            TU RESERVA EN GET<span>RESI</span></h1>
            <div id="contenedor-input">
                <div class="boton-presentacion"><a type="button" href="{{ url('beneficios') }}" class="btn btn-danger">PASE PREMIUM GR</a></div>
                <img src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}" alt="">
            </div>
        </div>
        <div id="fechas-residencias">
            <ion-icon name="calendar-outline"></ion-icon>
            <div><p class="checks">Check In</p><p>16/07/2024</p></div>
            <ion-icon name="arrow-forward-outline"></ion-icon>
            <div><p class="checks">Check Out</p><p>25/06/2025</p></div>
        </div>
        <div id="contenedor-residencias">
            @if ($residencias->isEmpty())
                <p>Residencias no disponibles en esta ciudad.</p>
            @else
                @foreach($residencias as $residencia)
                @if($residencia->estado == 'ACEPTADO')
                    <div class="residencias">
                        <img class="img-residencia" src="{{ URL::asset('resources/imgagenes_residencias/COLONIES BRUXELLES RUE.png') }}">
                        <div class="info-residencia">
                            <div class="div-opiniones">
                                <p>RESIDENCIA</p>
                                <div>Sin reseñas</div>
                            </div>
                            <p class="nombre-residencia">{{ $residencia->nombre_resi }}</p> 
                            <hr>
                            <div class="botonera-residencia">
                                <div>
                                    <p><ion-icon name="bed"></ion-icon></p>
                                    <p>Habitaciones Individuales</p>
                                </div>
                                <p class="boton-residencia">
                                    <a href="{{ url('ver-residencia', ['id_resi' => $residencia->id_resi]) }}">
                                        <ion-icon name="arrow-forward-circle"></ion-icon>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    
    <div id="carrusel-residencias"></div>
  
    </section>
    <div id="mapa-ciudad" ></div>
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
                <div class="cosas">
                    <img src="{{ URL::asset('/resources/logos_GR/GR_LOGO BLANCO.png') }}" alt="">
                    <h2>¿Necesitas ayuda?</h2>
                    <p>Contacta con nuestro equipo</p>
                    <button onclick="fShowContactanos()">CONTACTAR</button>
                </div>
                <form action="{{ route('send.email') }}" method='post'>
                    @csrf
                    <div id="formCorreo"></div>
                </form>
            </div>
        </div>
        <button id="boton-publicar">
            <?php
               if ($perfil==1){
                ?>
                <div><a type="button" href="{{ url('admindashboard') }}" class="btn btn-danger">Publica tu Residencia<p><ion-icon name="home"></ion-icon></p></a>
                   </div>
                   <?php   
               }elseif($perfil==3){
                   ?>
                    <div><a type="button" href="{{ url('dashboard') }}" class="btn btn-danger">Publica tu Residencia<p><ion-icon name="home"></ion-icon></p></a>
                   </div>
                   <?php
               } else {
                ?>
                <div><a type="button" href="{{ url('login') }}" class="btn btn-danger">Publica tu Residencia<p><ion-icon name="home"></ion-icon></p></a>
                </div>
                <?php
               }
            ?>  
        </button>
    </footer>

    <script src="{{ URL::asset('resources/js/ciudad.js') }}"></script>
    <script src="{{ URL::asset('resources/js/ciudad.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            google.maps.event.trigger(map, 'resize');
        });
        </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var categorias = document.querySelectorAll('.categoria');
        
        categorias.forEach(function(categoria) {
            categoria.addEventListener('click', function() {
                var info = categoria.querySelector('.info');
                
                // Cerrar todas las categorías abiertas
                var todasLasCategorias = document.querySelectorAll('.categoria');
                todasLasCategorias.forEach(function(otraCategoria) {
                    var otraInfo = otraCategoria.querySelector('.info');
                    if (otraInfo !== info) {
                        otraInfo.style.display = 'none';
                    }
                });
                
                // Toggle para mostrar u ocultar la información asociada a la categoría actual
                if (info.style.display === 'none') {
                    info.style.display = 'block';
                } else {
                    info.style.display = 'none';
                }
            });
            
            // Evitar que el clic en un checkbox cierre el div de información
            categoria.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });
    });
</script>   

<script>
 document.getElementById('filtroForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    var formData = new FormData(this);

    fetch('/filtResi', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Actualizar la vista con las residencias filtradas
        actualizarVista(data); // Llama a la función actualizarVista con los datos recibidos
        })
        .catch(error => console.error('Error:', error));
    });

    // Función para actualizar la vista con las residencias filtradas
    function actualizarVista(residencias) {
        var contenedorResidencias = document.getElementById('contenedor-residencias');
        contenedorResidencias.innerHTML = ''; // Vaciar el contenedor antes de agregar las nuevas residencias

        if (residencias.length === 0) {
            contenedorResidencias.innerHTML = '<p>Residencias no disponibles en esta ciudad.</p>';
        } else {
            residencias.forEach(function(residencia) {
                if (residencia.estado === 'ACEPTADO') {
                    var residenciaHTML = `
                        <div class="residencias">
                            <p>aaaaaaaaaaaaaaa </p>
                        </div>
                    `;
                    contenedorResidencias.innerHTML += residenciaHTML;
                }
            });
        }
    }
</script>
</script>

<script>
    function initMap() {
        var ciudadLatLng = { lat: {{ $latitud }}, lng: {{ $longitud }} };

        var map = new google.maps.Map(document.getElementById('mapa-ciudad'), {
            center: ciudadLatLng,
            zoom: 13    
        });

     

          // Recorrer las coordenadas de las residencias y agregar marcadores
          @foreach($residencias as $residencia)
        var residenciaLatLng = { lat: {{ $residencia->latitud }}, lng: {{ $residencia->longitud }} };
        var residenciaMarker = new google.maps.Marker({
            position: residenciaLatLng,
            map: map,
            title: '{{ $residencia->nombre_resi }}'
        });

        // Crear una ventana de información para cada marcador
        var infoWindow = new google.maps.InfoWindow({
            content: '<div>{{ $residencia->nombre_resi }} - 35-90€ </div>',
        });

        // Mostrar la ventana de información encima del marcador
        infoWindow.open(map, residenciaMarker);

        // Agregar un evento de clic al marcador para mostrar la información de la residencia
        residenciaMarker.addListener('click', function() {
            showResidenciaInfo('{{ url('ver-residencia', ['id_resi' => $residencia->id_resi]) }}');
        });
    @endforeach 
}

function showResidenciaInfo(url) {
    // Aquí puedes hacer lo que necesites con la URL, como redirigir a la página de la residencia
    window.location.href = url;
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUwrZUI61eat02XQkJhhPJfGOr3CyKhKE&callback=initMap" async defer></script>

</body>

</html>