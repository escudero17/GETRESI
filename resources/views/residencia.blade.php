<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residencia</title>
    <link rel="stylesheet" href="{{ URL::asset('resources/css/residencia.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        padding-top: 60px; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
</head>

<body onload="fOnLoad()">
    <header>
        <div>
            <a href="{{ url('/') }}">
                <img id="logo_header" src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" alt="">
            </a>
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

    <section>
        <div id="imgs-residencias">
            <div id="nombre-residencia">
                <i>{{ $residencia->nombre_resi }}</i>
                <img id="logo-residencias" src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}" alt="">
            </div>
            <div id="imagenes">
                @foreach($fotos_principales as $foto)                    
                <img id="img1" onclick="fCargarCarrusel()" src="{{ URL::asset('imgs/' . $foto->foto) }}" alt="">
                @endforeach
              
                <div id="contenedor-imagenes">
                     @php
                         $contador_imgs1 = 0;
                         $contador_imgs2 = 0;
                     @endphp
                        @foreach($fotos as $foto)
                            @if($foto->fotos_principales == 0)
                             @if($contador_imgs1 < 2)
                                 <img class="imgs1" onclick="fCargarCarrusel()" src="{{ URL::asset('imgs/' . $foto->foto) }}" alt="">
                                    @php
                                        $contador_imgs1++;
                                    @endphp
                                    @else
                                        <div class="imgs2">
                                            <img onclick="fCargarCarrusel()" src="{{ URL::asset('imgs/' . $foto->foto) }}" alt="">
                                        </div>
                                        @php
                                            $contador_imgs2++;
                                        @endphp
                                @endif
                             @endif
                         @endforeach
                </div>
        </div>
</div>

        <div id="carruselPhotos" style="display:none;">
            @foreach($fotos_carrusel as $foto)
            <img class="imgs1" src="{{ URL::asset('imgs/' . $foto->foto) }}" alt="">
            @endforeach
            <p id="cerrarModal" onclick="fCerrarModal()">X</p>
        </div>

        <div id="opciones-residencias">
            <p onclick="fOpenInfo()">Información</p>
            <p onclick="fOpenPrecios()">Habitaciones y precios</p>
            <p onclick="fOpenOpiniones()">Opiniones</p>
            <p onclick="fOpenPreguntasFrecuentes()">Preguntas frecuentes</p>
        </div>

        <div id="contenedor-infomacion">
            <div id="info-residencia-adicional" style="display: none;">
                <div id="div1">
                    <i>INFORMACIÓN</i>
                    <p>{{ $residencia->contenido }}</p>
                </div>
                <div id="div2">
                    <h3>¿Qué hay en esta residencia?</h3>
                    <div>
                        <p><ion-icon name="book-outline"></ion-icon>Zonas de estudio</p>
                        <p><ion-icon name="game-controller-outline"></ion-icon>Sala de juegos</p>
                        <p><ion-icon name="leaf-outline"></ion-icon>Terraza</p>
                        <p><ion-icon name="bicycle-outline"></ion-icon>Parking de bicicletas</p>
                        <p><ion-icon name="tv-outline"></ion-icon>Sala de televisión</p>
                    </div>
                </div> 
            </div>
            <!-- div para las habitaciones -->
        <div id="ctHab" style="display: none;">  
        <div id="contenido-habitaciones" style="display: none;">
                <div>
                <p id="inf">HABITACIONES Y PRECIOS</p>
               
                </div>
                @if(count($habitaciones) > 0)
            @foreach($habitaciones as $habitacion)
                <div class="habitaciones">
                    <img class="img-hab" src="{{ URL::asset('resources/imgagenes_residencias/COLONIES MARSEILLE BOULEVARD.png') }}">
                    <div class="info-hab">
                        <p class="nombre-residencia">{{ $habitacion->nombre }}</p>
                        <br>
                        <hr>
                        <br>
                        <br>
                        <div class="informacion_hab">
                            <p>Capacidad de {{ $habitacion->capacidad }} personas</p>
                            <p>Precio: {{ $habitacion->precio }}€/mes</p>
                        </div>
                    </div>  
                </div>
            @endforeach
            <div id="precioCaract">
                <h3>¿Qué incluye el precio?</h3>
                <div>
                    <p><ion-icon name="book-outline"></ion-icon>Agua</p>
                    <p><ion-icon name="game-controller-outline"></ion-icon>Servicio de limpieza</p>
                    <p><ion-icon name="leaf-outline"></ion-icon>Aire acondicionado</p>
                    <p><ion-icon name="bicycle-outline"></ion-icon>Electricidad</p>
                    <p><ion-icon name="tv-outline"></ion-icon>Wifi</p>
                </div>
            </div> 
        @else
            <p id="noHab">Habitaciones no disponibles</p>
        @endif
           
            <div id="contenido-opiniones" style="display: none;">
                 <div>
                <p id="inf">Opiniones</p>
               
                </div>

                <div id="rating">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
                <p>9.80 sobre 10(10 reseñas)</p>
                </div>

                  <div id="opinions">
                     <div class="box">
                   <div class="opinuser">   
                 <h4>Carla Sanchez</h4>
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>8.0
                 </div>
                 <p>Me encantan las vistas.</p>
                  </div>

                 <div class="box">
                 <div class="opinuser">
              <h4>Alfonso Ruiz</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                 <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                 </svg>9.0
                 </div>
                 <p>Un trato acogedor, se lo recomendaría a todo el mundo.</p>
                 </div>

                 <div class="box">
                 <div class="opinuser">
                 <h4>Juan Peréz</h4>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                 <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                 </svg>10.0
                  </div>
                  <p>Un sitio sorpendente con un trato maravilloso</p>
                 </div>

                </div>    
            </div>
     
    <div id="contenido-preguntas">
    <div id="fqs">
                <i>FAQS</i>
         
            </div>
    @for ($i = 0; $i < 4; $i++)
        <div class="columna">
            @for ($j = 0; $j < 8; $j++)
                @php
                    $index = $i * 4 + $j;
                    $pregunta = $preguntas[$index];
                    $respuesta = $respuestas[$index];
                @endphp
                <div class="pregunta" data-pregunta="{{ $pregunta->id_pregunta }}">
                    <h4>{{ $pregunta->pregunta }}</h4>
                    <div class="respuesta">{{ $respuesta->respuesta }}</div>
                </div>
            @endfor
        </div>
    @endfor
</div>

    </div>
 
        








</div>
</div>
        <div id="infMap">
        <i>¿Donde estamos?</i>
        </div>
     
        <div id="mapa-residencia"></div>

        <div id="reserva">
     

        <button class="btn-reservar" data-id="{{ $residencia->id_resi }}">Reservar</button>
        </div>

        <div id="reservaModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="reservaForm" action="{{ route('sendReservaEmail') }}" method="POST">
            @csrf
            <input type="hidden" name="id_resi" id="id_resi">
            <div class="form-group">
                <label for="correo">Tu Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="asunto">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" required>
            </div>
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Enviar</button>
            </div>
        </form>
    </div>
</div>
        <div id="modalAyuda" class="modal">
    <div class="modal-content">
    <span class="close" onclick="ocultarModal()">&times;</span>
    <input type='text' id="correo" name='correo' placeholder='Correo'>
    <input type='text' id="comentario" name='contenido' placeholder='Escribe aquí tu comentario'>
    <a href="">Enviar</a>
    </div>
</div>
     
<div id="homepage-ubicaciones">
    <em><h2>Residencias <span id="negro">Más Solicitadas</span></h2></em>
    <div id="carrusel-residencias">
        @foreach($residenciasDestacadas as $residenciaDestacada)
            <div class="residencias">
                <img class="img-residencia" src="{{ URL::asset('resources/imgagenes_residencias/COLONIES BRUXELLES RUE.png') }}">
                <div class="info-residencia">
                    <div class="div-opiniones">
                        <p>RESIDENCIA</p>
                        <div>Sin reseñas</div>
                    </div>
                    <p class="nombre-residencia">{{ $residenciaDestacada->nombre_resi }}</p>
                    <hr>
                    <div class="botonera-residencia">
                        <div>
                            <p><ion-icon name="bed"></ion-icon></p>
                            <p>Habitaciones Individuales</p>
                        </div>
                        <p class="boton-residencia">
                            <a href="{{ url('ver-residencia', ['id_resi' => $residenciaDestacada->id_resi]) }}">
                                <ion-icon name="arrow-forward-circle"></ion-icon>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
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
                <div><a type="button" href="{{ url('admindashboard') }}" class="btn btn-danger">Publica tu Residencia<ion-icon name="home" class="home"></ion-icon></a>
                   </div>
                   <?php   
               }elseif($perfil==3){
                   ?>
                    <div><a type="button" href="{{ url('dashboard') }}" class="btn btn-danger">Publica tu Residencia<ion-icon name="home" class="home"></ion-icon></a>
                   </div>
                   <?php
               } else {
                ?>
                <div><a type="button" href="{{ url('login') }}" class="btn btn-danger">Publica tu Residencia<ion-icon name="home" class="home"></ion-icon></a>
                </div>
                <?php
               }
            ?>  
        </button>
    </footer>
    <script>
    $('#reservaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idResi = button.data('id');
        var modal = $(this);
        modal.find('#id_resi').val(idResi);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var modal = document.getElementById("reservaModal");
        var span = document.getElementsByClassName("close")[0];
        var buttons = document.getElementsByClassName("btn-reservar");

        Array.prototype.forEach.call(buttons, function(button) {
            button.onclick = function() {
                var idResi = this.getAttribute('data-id');
                modal.style.display = "block";
                document.getElementById("id_resi").value = idResi;
            };
        });

        span.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });
</script>
    <script src="{{ URL::asset('resources/js/residencia.js') }}"></script>
    <script type="text/javascript">
       window.addEventListener('DOMContentLoaded', (event) => {
    var cerrarModal = document.getElementById("cerrarModal");

    // Función para ajustar la posición del botón "X" al hacer scroll
    function ajustarPosicionX() {
        // Obtener la distancia de desplazamiento vertical de la ventana
        var scrollY = window.scrollY || window.pageYOffset;

        // Ajustar la posición vertical del botón "X" basándose en el desplazamiento vertical de la ventana
        cerrarModal.style.top = Math.max(20 - scrollY, 0) + "px";
    }

    // Escuchar eventos de desplazamiento en la ventana
    window.addEventListener('scroll', ajustarPosicionX);

    // Ajustar la posición inicialmente
    ajustarPosicionX();
});

// Función para ocultar el modal
function ocultarModal() {

    var modalAyuda = document.getElementById("modalAyuda");
    modalAyuda.style.display = "none";
  
}
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.pregunta').click(function() {
            $(this).find('.respuesta').slideToggle();
        });
    });
</script>

<script>
    function initMap() {
        // Coordenadas de la residencia
        var residenciaLatLng = { lat: {{ $latitud }}, lng: {{ $longitud }} };

        // Opciones del mapa
        var mapOptions = {
            center: residenciaLatLng, // Centrar el mapa en la ubicación de la residencia
            zoom: 15, // Nivel de zoom
       
        };

        // Crear el mapa con las opciones
        var map = new google.maps.Map(document.getElementById('mapa-residencia'), mapOptions);

        // Marcador de la residencia
        var residenciaMarker = new google.maps.Marker({
            map: map,
            position: residenciaLatLng,
            title: '{{ $residencia->nombre_resi }}'
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUwrZUI61eat02XQkJhhPJfGOr3CyKhKE&callback=initMap" async defer></script>
</body>

</html>
