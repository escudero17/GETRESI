<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET RESI</title>
    <link rel="stylesheet"  href="{{ URL::asset('resources/css/homepage.css') }}" >
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body onload="fCargarHomepageCiudades()">

    <header>
        <video autoplay muted loop id="video-scroll">
            <source src="{{ URL::asset('resources/beneficiosimg/HOMEPAGE_VIDEO(1).mp4') }}" type="video/mp4">
        </video>
        <div id="header-principal">
            <div id="header-logo">
                <img src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}" alt="">
            </div>
            <div id="header-botonera">
                <?php
               if($perfil==3){
                   ?>
                    <div><a type="button" href="{{ url('dashboard') }}" class="btn btn-danger">Publica tu Residencia<p><ion-icon name="home"></ion-icon></p></a>
                   </div>
                   <?php
               }
               ?>
                @php
                $usuario_log = session('usuario_activo');

                if(isset($usuario_log) && is_array($usuario_log) && count($usuario_log) > 0) {
                    $perfil = $usuario_log[0]->id_perfil;  
                }
                @endphp

                @if(isset($usuario_log))
                    @if($perfil == 1)  
                        <div><a type="button" href="{{ url('admindashboard') }}" class="btn btn-danger">Admin Dashboard<p><ion-icon name="person-circle"></ion-icon></p></a></div>
                        <div><a type="button" href="{{ url('logout') }}" class="btn btn-danger">Cerrar Sesión<p><ion-icon name="person-circle"></ion-icon></p></a></div>
                    @elseif($perfil == 2 || $perfil == 3)
                        <!-- Botón con menú desplegable -->
                        <div class="dropdown" style="position: relative;">  
                            <div>
                                <button type="button" class="btn btn-danger" id="btnMiCuenta" onclick="fShowMenu()">Mi Cuenta<p><ion-icon name="person-circle"></ion-icon></p></button>
                            </div>
                            <div id="dropdownMenu" class="dropdown-menu" aria-labelledby="btnMiCuenta" style="display: none;" style="display: none; position: absolute; top: 100%; left: 0;">
                                <div><a class="dropdown-item" href="{{ url('miCuenta') }}" style="border-radius: 0px;">Cuenta</a></div>
                                <div><a class="dropdown-item" href="#"  style="border-radius: 0px;">Mensajes</a></div>
                                <div><a type="button" href="{{ url('/logout') }}" class="dropdown-item">Cerrar sesión</a></div>

                            </div>
                        </div>
                    @endif
                @else
                    <div><a type="button" href="{{ url('login') }}" class="btn btn-danger">Mi Cuenta<p><ion-icon name="person-circle"></ion-icon></p></a></div>
                @endif

            </div>
        </div>
        <div id="contenedor-principal">
            <div id="buscador-principal">
                <i>ENCUENTRA TU RESIDENCIA DE ESTUDIANTES</i>
                <div id="contenedor-buscador">
                    <p>¿En qué ciudad vas a estudiar?</p>
                    <div id="contenedor-input">
                        <form action="{{route('findByName')}}" method="POST">
                            @csrf
                            <input id="input-buscador" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Madrid, España" type="text">
                            <button type="submit" id="boton-buscar-ciudades"  ><ion-icon name="arrow-forward-circle"></ion-icon></button>
                        </form>
                    </div>
                    <div id="contendor-ciudades-buscador">
                    <div class="ciudad-buscador">
                <p><ion-icon name="navigate"></ion-icon></p>
                <a href="{{ route('buscarPorCiudad', ['nombre_ciudad' => 'madrid']) }}"><p>Madrid</p></a>
            </div>
            <div class="ciudad-buscador">
                <p><ion-icon name="navigate"></ion-icon></p>
                <a href="{{ route('buscarPorCiudad', ['nombre_ciudad' => 'barcelona']) }}"><p>Barcelona</p></a>
            </div>
            <div class="ciudad-buscador">
                <p><ion-icon name="navigate"></ion-icon></p>
                <a href="{{ route('buscarPorCiudad', ['nombre_ciudad' => 'sevilla']) }}"><p>Sevilla</p></a>
            </div>
                        <p id="icono-buscador"><ion-icon name="location-sharp"></ion-icon></p>
                    </div>
                   
                </div>
            </div>
        </div>
        <div id="logos-partners">
            <div class="logo-partner"><img style="width: 100px;" src="{{ asset('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img style="width: 100px;" src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img style="width: 100px;" src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img style="width: 100px;" src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img style="width: 100px;" src="{{ URL::asset('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
        </div>
    </header>
    <section>
        <div id="contenedor-info">
            <div id="foto-presentacion"></div>
            <div id="info-presentacion">
                <i>UNA <span>EMPRESA LÍDER</span> EN LA BÚSQUEDA DE <span>ALOJAMIENTO UNIVERSITARIO</span></i>
                    <p style="color:black">
                        <b>Busca, compara y reserva tu residencia universitaria en getresi.es</b> <br>
                        Sabemos que buscar una residencia de estudiantes es un proceso complicado. En <em style="font-size: 20px;">getresi.es</em> podrás
                        buscar, comparar y elegir la que mejor se adapte a ti. Estamos aquí para facilitarte la vida. <br>
                        <b>¡Encuentra tu residencia y ahorra tiempo!</b>
                    </p>
                <div id="botonera-presentacion">
                    <div class="boton-presentacion"><a type="button" href="{{ url('buscar/Madrid') }}" class="btn btn-danger">BUSCA TU RESIDENCIA</a></div>
                </div>
            </div>
        </div>
        
        <div id="contenedor-beneficios">
            <div id="info-beneficios">
                <i>REALIZA TU RESERVA CON NOSOTROS Y <span>GANA PREMIOS</span> DURANTE EL AÑO</i> <br>
                <b>Elige tu residencia universitaria en <i style="font-size: 16px;">getresi.es</i> y gana premios por ello.</b>
                <p>
                    Sí, ¡lo has entendido bien! Al realizar tu matrícula con nosotros recibirás un pase premium GR
                    con el que podrás acceder a premios, descuentos y entradas anticipadas para conciertos.
                </p>
                <b>¡Somos los únicos en ofrecértelo!</b>
                <div id="botonera-presentacion">
                    <div class="boton-presentacion"><a type="button" href="{{ url('beneficios') }}" class="btn btn-danger">PASE PREMIUM GR</a></div>
                </div>
            </div>
            <div id="contenedor-logos">
                <div id="logo_1"></div>
                <div id="logo_2"></div>
                <div id="logo_3"></div>
                <div id="logo_4"></div>
            </div>
        </div>
        <div id="homepage-ubicaciones">
            <i>ELIGE TU<span> RESIDENCIA</span></i>
            <div id="carrusel-residencias">
                @foreach($residencias as $residencia)
                @if($residencia->destacada)
                @if($residencia->estado == 'ACEPTADO')
                <div class="residencias">
                    <img class="img-residencia" src="{{ URL::asset('resources/imgagenes_residencias/COLONIES BRUXELLES RUE.png') }}">
                    <div class="info-residencia">
                        <div class="div-opiniones">
                            <p>RESIDENCIA</p>
                            <div>Sin reseñas</div>
                        </div>
                        <p class="nombre-residencia">{{$residencia->nombre_resi}}</p>
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
                @endif
                @endforeach  
            </div>
        </div>
        <div id="modalAyuda" class="modal">
            <div class="modal-content">
            <span class="close" onclick="ocultarModal()">&times;</span>
            <input type='text' id="correo" name='correo' placeholder='Correo' required>
            <input type='text' id="comentario" name='contenido' placeholder='Escribe aquí tu comentario' required>
            <a href="">Enviar</a>
        </div>
</div>
        <div id="homepage-ciudades">
            <i id="titulo-ciudades">CIUDADES<span style="color:black; font-weight: 1000;"> MÁS SOLICITADAS</span></i>
            <div id="contenedor-ciudades">
                
                @foreach($ciudades as $ciudad) 
                    @if($ciudad->nombre_ciu == "madrid")
                        <div class='ciudad-grande'  id='madrid'>
                            <div>
                                <a style='font-size: 30px;' href="{{ route('buscarPorCiudad', ['nombre_ciudad' => $ciudad->nombre_ciu]) }}">{{ $ciudad->nombre_ciu }}</a>
                                <p>{{ $ciudad->num_residencias }} residencias</p>
                            </div>
                        </div>
                    @endif
                    @if($ciudad->nombre_ciu == "barcelona" )
                        <div class='ciudad-grande'  id='barcelona'>
                            <div>
                                <a style='font-size: 30px;' href="{{ route('buscarPorCiudad', ['nombre_ciudad' => $ciudad->nombre_ciu]) }}">{{ $ciudad->nombre_ciu }}</a>
                                <p>{{ $ciudad->num_residencias }} residencias</p>
                            </div>
                        </div>
                    @endif
                @endforeach
                @foreach($ciudades as $ciudad) 
                    @if($ciudad->nombre_ciu == "granada" || $ciudad->nombre_ciu == "salamanca" || $ciudad->nombre_ciu == "sevilla" || $ciudad->nombre_ciu == "valencia"  )
                    <div class='ciudad-mediana'  id='{{ $ciudad->nombre_ciu }}'>
                        <div>
                            <a style='font-size: 20px;' href="{{ route('buscarPorCiudad', ['nombre_ciudad' => $ciudad->nombre_ciu]) }}">{{ $ciudad->nombre_ciu }}</a>
                            <p style='font-size: 20px; color:white;'>{{ $ciudad->num_residencias }} residencias</p>
                        </div>
                    </div>
                    @endif
                @endforeach
                @foreach($ciudades as $ciudad) 
                    @if($ciudad->nombre_ciu == "malaga" || $ciudad->nombre_ciu == "valladolid" ||$ciudad->nombre_ciu == "bilbao" ||$ciudad->nombre_ciu == "donostia" || $ciudad->nombre_ciu == "leon" ||$ciudad->nombre_ciu == "zaragoza" ||$ciudad->nombre_ciu == "caceres" ||$ciudad->nombre_ciu == "alicante" ||$ciudad->nombre_ciu == "toledo" ||$ciudad->nombre_ciu == "murcia" ||$ciudad->nombre_ciu == "oviedo" ||$ciudad->nombre_ciu == "cordoba" )
                    <div class='ciudad'  id='ciudad_{{ $ciudad->id_ciu }}'>
                        <div>
                            <a style='font-size: 20px;' class='name_ciu' href="{{ route('buscarPorCiudad', ['nombre_ciudad' => $ciudad->nombre_ciu]) }}">{{ $ciudad->nombre_ciu }}</a>
                            <p>{{ $ciudad->num_residencias }} residencias</p>
                        </div>
                    </div>
                    @endif
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
    <script src="{{ URL::asset('resources/js/index.js') }}"></script>
    <script>
        // Función para ocultar el modal
function ocultarModal() {
 
    var modalAyuda = document.getElementById("modalAyuda");
    modalAyuda.style.display = "none";
  
}
    </script>
</body>

</html>