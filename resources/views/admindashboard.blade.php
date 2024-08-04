<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET RESI</title>
    <link rel="stylesheet" href="{{ URL::asset('resources/css/dashboardAdmin.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/ereader.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/log-out.css' rel='stylesheet'>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body onload="fCargar()">
<header>
    <div id="title_GR">
        <div id="logo">
            <a href="{{ url('admindashboard') }}">
                <img id="GR" src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" width="40px" alt="">
            </a>
        </div>
    </div>
</header>

<aside>
    <div id="asideAll">
        <div id="asideT">
            <button onclick="FinicioA()" class="inicioI">Mis solicitudes</button>
            <button onclick="fMostrarUsuariosGr()" class="inicioI">Usuarios GR+</button>
            <button onclick="fResisAprobadas()" class="inicioI">Residencias</button>
            <button onclick="fMostrarUsuarios()" class="inicioI">Usuarios</button>
        </div>
        <div id="asideAj">
            <button class="inicioI">
                <i class="gg-log-out"></i>
                <a href="{{url('/') }}"> Volver </a>
            </button>
        </div>
    </div>
</aside>

<section>
    <!-- Te imprime los cuatro botones de administración en grande -->
    <div class="botoneras">
        <div class="botonera-container">
            <div class="botonera">
                <button onclick="FinicioA()" class="">Mis solicitudes</button>
            </div>
            <div class="botonera">
                <button onclick="fResisAprobadas()" class="">Mis residencias</button>
            </div>
        </div>
        <div class="botonera-container">
            <div class="botonera">
                <button onclick="fMostrarUsuarios()" class="">Usuarios</button>
            </div>
            <div class="botonera">
                <button onclick="fMostrarUsuariosGr()" class="">Usuarios GR+</button>
            </div>
        </div>
    </div>
    <!-- Te muestra "Mis solicitudes" -->
    <div id="tarj"> 
        @foreach($residencias as $residencia)
            <div id="contR">
                <p>{{$residencia->nombre_resi}}</p>
                <div id="tarjB">
                <button class="btA" onclick="fVerDetalle('{{ $residencia->nombre_resi }}', '{{ $residencia->ubicacion }}', '{{ $residencia->url }}', '{{ $residencia->contenido }}')">Ver Detalle</button>                   
                <form action="{{ route('residencia.aceptar', ['id_resi' => $residencia->id_resi]) }}" id="formBtn" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btB">Aceptar Residencia</button>
                    </form>


                <form action="{{ route('cancel', ['id_resi' => $residencia->id_resi]) }}"  id="formBtn" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btB">Cancelar Residencia</button>
            </form>
                </div>
            </div>
        @endforeach
    </div>

   <!-- Imprime las resis aprobadas -->
    <div id="aprobadas">
        @foreach($residencias as $residencia)
        @if($residencia->destacada=0)
            <div class="residencia">
                <p>{{$residencia->nombre_resi}}</p>
                <form action="{{ route('destacar', ['id' => $residencia->id_usuario]) }}" method="POST">
            @csrf
            @method('POST')
            <button type="submit">Destacar</button>
        </form>
            </div>
            @endif
        @endforeach
    </div>
    
       <!-- Imprime las resis destacadas -->
       <div id="aprobadas">
        @foreach($residencias as $residencia)
        @if($residencia->destacada=1)
            <div class="residencia">
                <p>{{$residencia->nombre_resi}}</p>
               
            </div>
            @endif
        @endforeach
    </div>

    <!-- Te imprime los usuarios logeados -->
    <div id="usuariosLogeados">
       @foreach($usuarios as $usuario)
       @if($usuario->matriculado ==0)
       @if($usuario->id_perfil !=3 && $usuario->id_perfil !=1)
        <div>
            <p>{{$usuario->nombre}}</p>
            <form action="{{ route('matricularUsuario', ['id' => $usuario->id_usuario]) }}" method="POST">
            @csrf
            @method('POST')
            <button type="submit">Matricular</button>
        </form>

    <form method="POST" action="{{ route('eliminarUsuario', ['id' => $usuario->id_usuario]) }}">
   @csrf
    @method('DELETE')
    <button type="submit">Eliminar</button>
</form> 
          
          
        </div>
        @endif
        @endif
       @endforeach
    </div>
    <div id="usuariosGr">
       @foreach($usuarios as $usuario)
       @if($usuario->matriculado ==1)
       @if($usuario->id_perfil !=3 && $usuario->id_perfil !=1)
        <div>
            <p>{{$usuario->nombre}}</p>
        </div>
        @endif
        @endif
       @endforeach
    </div>

    <!-- Ves el detalle de una residencia en "Mis solicitudes" -->
   <div id="verDetalle">
        <div id="contenido"></div>
    <button id="boton" style="display:none;"><a  href="{{url('admindashboard') }}">Volver</a></button>
   </div>

</section>
<script>
    function confirmDelete() {
        if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
<script src="{{ URL::asset('resources/js/dashboardAdmin.js') }}"></script>
</body>

</html>