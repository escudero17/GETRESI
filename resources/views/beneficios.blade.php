
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetResi</title>
    <link rel="stylesheet" href="{{ URL::asset('resources/css/beneficios.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <header>
        <div id="header-principal">
            <div id="header-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}" alt="">
                </a>
            </div>
            <div id="header-botonera">
           
        
        @if($perfil === 1)
            <div><a type="button" href="{{ url('admindashboard') }}" class="btn btn-danger">Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon> </a></div>
        @elseif($perfil === 2)
            <div><a type="button" href="{{ url('dashboard') }}" class="btn btn-danger"> Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon></a></div>
        @elseif($perfil === 3)
            <div><a type="button" href="{{ url('dashboard') }}" class="btn btn-danger"> Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon></a></div>
        @else
        <div><a type="button" href="{{ url('login') }}" class="btn btn-danger"> Publica tu Residencia<ion-icon name="home" id="homee"></ion-icon></a></div>
        @endif
        <div><a type="button" href="{{ url('miCuenta') }}" class="btn btn-danger">Mi Cuenta<ion-icon name="person-circle" id="user"></ion-icon></a></div>
     
           
        </div>
      
        </div>
        <div id="contenedor-principal">
            <div id="buscador-principal">
                <i>DESCUBRE LAS VENTAJAS DE PERTENECER A LA COMUNIDAD GR</i>
            </div>
        <video autoplay muted loop id="video-scroll">
            <source src="{{ URL::asset('resources/beneficiosimg/BENEFICIOSGR_VIDEO.mp4') }}" type="video/mp4">
        </video>
        </div>
        </div>
        <div id="logos-partners">
            <div class="logo-partner"><img src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img style="width: 100px;"
                    src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
            <div class="logo-partner"><img src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}">
            </div>
            <div class="logo-partner"><img src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}">
            </div>
        </div>
    </header>
    <section>
        <div id="contenedor-info">
            <div id="info-presentacion">
                <div id="redbull">
                    <div class="titulo">
                        <p>GET <span>RESI</span></p>
                    </div>
                    <div id="descripcionMarca">
                    <p style="color: white;">[ DESCRIPCIÓN DE LA MARCA ]</p> <br>
                   
                    <p><span>[ESLOGAN]</span></p>
                    </div>
                </div>
                <div class="imagen"><img src="{{ URL('resources/logos_GR/GR_LOGO BLANCO.png') }}"></div>
                </div>
            <div id="imagenes-carrusel">
            @if(!session()->has('usuario_activo'))
             

                 <div class="imagen1">
                     <img id="mouse" style=" filter: brightness(50%);" src="{{ URL('resources/beneficiosimg/BENEFICIO_01.jpeg') }}">
                         <button class="boton-carrusel" onclick="mostrarModal()">DESBLOQUÉALO</button>
                 </div>
                 <div class="imagen1">
                     <img  style=" filter: brightness(50%);" src="{{ URL('resources/beneficiosimg/BENEFICIO GOIKO 01.png') }}">
                        <button class="boton-carrusel" onclick="mostrarModal()">DESBLOQUÉALO</button>
                  </div>
                 <div class="imagen1">
                     <img  style=" filter: brightness(50%);" src="{{ URL('resources/beneficiosimg/BENEFICIO_03.jpeg') }}">
                          <button class="boton-carrusel" onclick="mostrarModal()">DESBLOQUÉALO</button>
                    </div>
             
            @elseif(session('usuario_activo')[0]->matriculado == 0)
                <div class="imagen1">
                    <img id="mouse" src="{{ URL('resources/beneficiosimg/BENEFICIO_01.jpeg') }}">
                    <button class="boton-carrusel" onclick="fReclamalo()">RECLÁMALO</button>
                </div>
                <div class="imagen1">
                    <img src="{{ URL('resources/beneficiosimg/BENEFICIO GOIKO 01.png') }}">
                    <button class="boton-carrusel"  onclick="fReclamalo()">RECLÁMALO</button>
                 
                </div>
                <div class="imagen1">
                    <img  style=" filter: brightness(50%);" src="{{ URL('resources/beneficiosimg/BENEFICIO_03.jpeg') }}">
                    <button class="boton-carrusel">DESBLOQUÉALO</button>
                </div>
             @elseif(session('usuario_activo')[0]->matriculado == 1)
                <div class="imagen1">
                    <img id="mouse" src="{{ URL('resources/beneficiosimg/BENEFICIO_01.jpeg') }}">
                    <button class="boton-carrusel" onclick="fReclamalo()">RECLÁMALO</button>
                </div>
                <div class="imagen1">
                    <img src="{{ URL('resources/beneficiosimg/BENEFICIO GOIKO 01.png') }}">
                    <button class="boton-carrusel">RECLÁMALO</button>
                </div>
                <div class="imagen1">
                    <img src="{{ URL('resources/beneficiosimg/BENEFICIO_03.jpeg') }}">
                    <button class="boton-carrusel">RECLÁMALO</button>
                </div>
                @endif
            </div>
        </div>

    <div id="modalRegister" class="modal">
         <div class="modal-content">
        <span class="close" onclick="ocultarModal()">&times;</span>
        <p>Para reclamar este premio tienes que registrarte</p>
        <br>
        <br>
        <a href="{{ url('/register') }}">Registrate</a>
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

    <div id="modalReclamalo" class="modal" data-claves-residencias="{{ json_encode($Clave) }}">
         <div class="modal-content">
        <span class="close" onclick="ocultarModal()">&times;</span>
        <p>Introduce el código que la residencia te haya proporcionado para reclamar este beneficio</p>
        <br>
        <input type="text" id="claveInput" maxlength="8" placeholder="Introduce la clave">
        <br>
        <button onclick="validarClave()">Reclamar</button>
        <br>
        <p id="mensajeValidacion"></p>
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
    <script src="{{ URL('resources/js/beneficios.js') }}"></script>
    <script>
        function mostrarMensajeValidacion(mensaje) {
    // Obtener referencia al elemento del modal
    var modalContent = document.querySelector("#modalReclamalo .modal-content");

    // Limpiar el contenido actual del modal
    modalContent.innerHTML = "";

    // Crear un nuevo elemento para el mensaje de validación
    var mensajeElemento = document.createElement("p");
    mensajeElemento.innerText = mensaje;

    // Agregar el mensaje de validación al contenido del modal
    modalContent.appendChild(mensajeElemento);
      // Agregar el botón para cerrar el modal
      var closeButton = document.createElement("span");
    closeButton.className = "close";
    closeButton.innerHTML = "&times;";
    closeButton.onclick = ocultarModal;
    modalContent.appendChild(closeButton);
}

    function validarClave() {
        var claveIngresada = parseInt(document.getElementById("claveInput").value.trim(), 10); // Convertir a número
    var clavesResidencias = JSON.parse(document.getElementById("modalReclamalo").getAttribute("data-claves-residencias"));

    // Variable para indicar si se encontró una clave coincidente
    var claveCorrecta = false;

    // Recorrer el array de claves de residencias
    for (var i = 0; i < clavesResidencias.length; i++) {
        // Comparar la clave ingresada con la clave actual del bucle
        if (claveIngresada === parseInt(clavesResidencias[i], 10)) { // Convertir a número
            claveCorrecta = true;
            break; // Salir del bucle si se encuentra una coincidencia
        }
    }

    // Mostrar mensaje de validación según el resultado
    if (claveCorrecta) {
        mostrarMensajeValidacion("Clave correcta. ¡Beneficio reclamado!");
    } else {
        mostrarMensajeValidacion("La clave es incorrecta. Por favor, ingresa la clave correcta.");
    }
}
    </script>
    <script>
// Función para mostrar el modal
function mostrarModal() {
    var modal = document.getElementById("modalRegister");
    modal.style.display = "block";
}
// Función para mostrar el modal
function fReclamalo(beneficioId) {
    var modal = document.getElementById("modalReclamalo");  
    modal.style.display = "block";
}

// Función para ocultar el modal
function ocultarModal() {
    var modal = document.getElementById("modalRegister");
    modal.style.display = "none";
    var modalReclamalo = document.getElementById("modalReclamalo");
    modalReclamalo.style.display = "none";
    var modalAyuda = document.getElementById("modalAyuda");
    modalAyuda.style.display = "none";
  
}
</script>
</body>

</html>