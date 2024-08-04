
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET RESI</title>
    <link rel="stylesheet"  href="{{ URL::asset('resources/css/dashboard1.css') }}" >
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
                <!-- Bootstrap CSS v5.2.1 -->
                <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/ereader.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/log-out.css' rel='stylesheet'>
</head>

<body>

<aside>
    <div id="title_GR">
        <a href="{{ url('/') }}">
            <img id="GR" src="{{ URL::asset('resources/logos_GR/GR_LOGO NEGRO.png') }}" width="40px" alt="">
        </a>
    </div>
    <a class="inicioI" href="{{ url('dashboard') }}">
        <i class="gg-log-out"></i>
        <span>Volver</span>
    </a>
</aside>

<header>
   <!-- Imprimimos el nombre de la categoría y cuando pinches en una se te imprime el form con sus características -->
   <div id="categories" data-habitaciones="{{json_encode($habitaciones)}}" data-imagenes="{{json_encode($imagenes)}}" data-respuestas="{{ json_encode($respuestas) }}" data-caracteristicas="{{ json_encode($caracteristicas) }}" data-preguntas="{{ json_encode($preguntas) }}" data-residencia-caracteristicas="{{ json_encode($residencia_caracteristicas) }}">
        @foreach($categorias as $categoria)
            @if($categoria->id_cat_resi == 5)
                <p onclick="fShowPreguntas(this)">{{$categoria->nombre_cat}}</p>
            @elseif($categoria->id_cat_resi == 6)
                <p onclick="fShowFileForm(this, {{ $id }})">{{$categoria->nombre_cat}}</p>
            @elseif($categoria->id_cat_resi == 7)
            <p onclick="fShowHabitacionForm(this, {{$id}})">{{$categoria->nombre_cat}}</p>
            @else
            <p onclick="fShowForm(this, {{$categoria->id_cat_resi}} )">{{$categoria->nombre_cat}}</p>
            @endif
        @endforeach
</header>
<section>
  
 <!-- Formulario donde se imprimen las características -->
    <form id="caracteristicas-form" action="{{ route('caracteristica.add', ['id_resi' => $id]) }}" method="post">
        @csrf
        <div id="caracteristicas"></div>
    </form>

    <!-- Formulario donde se imprimen las preguntas -->
    <form id="preguntas-form" action="{{ route('pregunta.add', ['id_resi' => $id]) }}" method="post">
        @csrf
        <div id="preguntas"></div>
    </form>

    <!-- Formulario con input type file para las fotos principales -->
    <form id="file-main-form" class="cerrarFto" action="{{ route('upload.main.files', ['id_resi' => $id]) }}" method="post" enctype="multipart/form-data" style="display: none;">
        @csrf
        <h3>Sube la imagen principal de tu residencia</h3>
        <h4>(será la primera que vean los estudiantes)</h4>
        <br>
        <input id="input-main" type="file" name="imagenes[]" multiple>
        <div id="image-main-preview"></div>
        <button type="submit">Subir imágenes</button>
    </form>
    <br>
    <br>
    <!-- Formulario con input type file para las fotos restanes-->
    <form id="file-form" action="{{ route('upload.files', ['id_resi' => $id]) }}" method="post" enctype="multipart/form-data" style="display: none;">
        @csrf
        <h3>Sube las fotos restantes de tu residencia</h3>
        <input id="input-secondary" type="file" name="imagenes[]" multiple>
        <div id="image-preview"></div>
        <button type="submit">Subir imágenes</button>
    </form>
    
    <!-- Imprimir imágenes ya insertadas con opción de eliminarlas de la bd -->
        <div id="imagenes" style="display: none;">
            @foreach($imagenes as $imagen)
                <img class="imgs-dashboard" src="{{ asset('imgs/' . $imagen->foto) }}" alt="Imagen" width="300px">
                <a href="{{ route('delete.files', ['id_resi' => $id, 'foto' => $imagen->foto]) }}" onclick="fShowFileForm( {{ json_encode($imagenes) }} , {{$id}} )">Eliminar</a>
            @endforeach
        </div>

    <!-- Div para albergar los botones de "crear habitación" -->
    <div id="botonera-habitacion">
            
    </div>

    <!-- Formulario para insertar una habitación -->
    <form method="post"  action="{{ route('habitaciones.add', ['id_resi' => $id]) }}">
        @csrf
        <div id="form-habitaciones"></div>
    </form>
    
    <!-- Impresión de datos de la habitación para udpate -->
<div id="editHab" style="display:none;">
    @foreach($habitaciones as $habitacion)
    <form id="hab_{{$habitacion->id_hab}}" method="post" action="{{ route('habitaciones.update', ['id_hab' => $habitacion->id_hab]) }}">
        @csrf
        <label for='nombre'>Nombre de la habitación</label>
        <br> 
        <input value='{{$habitacion->nombre}}' name='nombre' type='text'>
        <br>
        <label for='descripcion'>Descripción de la habitación</label>
        <br>
        <input value='{{$habitacion->descripcion}}' name='descripcion' type='text'></input>
        <br>
        <label for='capacidad'>Capacidad de la habitación</label>
        <br>
        <input value='{{$habitacion->capacidad}}' name='capacidad' type='number'>
        <br>
        <br>
        <label for='precio'>Precio base de la habitación</label>
        <br>
        <input value='{{$habitacion->precio}}' name='precio' type='number'>
        <br>
        <p>Disponibilidad</p>
        <div class='check'>
        @if($habitacion->disponibilidad = 1)
            <input value='1' name='disponibilidad' type='checkbox' checked >Disponible
            <input value='0' name='disponibilidad' type='checkbox'>No disponible
        @else
            <input value='1' name='disponibilidad' type='checkbox'>Disponible
            <input value='0' name='disponibilidad' type='checkbox' checked >No disponible
        @endif
        </div>
        <button type='submit'> Guardar Cambios </button>
    </form>

    <div id="caracteristicas-hab">        
        <form action="{{ route('habitaciones.caracteristicas', ['id_hab' => $habitacion->id_hab]) }}" method="post">
        @csrf
        @foreach($categoriashab as $categoria)
            <p>{{$categoria->nombre_cat}}</p>
            <select name="{{$categoria->id_cat_habit}}">
                @foreach($caracteristicashab as $caracteristica)
                    @if($caracteristica->id_cat_habit == $categoria->id_cat_habit)
                        <option value="{{$caracteristica->id_caracteristica}}">{{$caracteristica->nombre_carac}}</option>
                    @endif
                @endforeach
            </select>
        @endforeach
        <button type="submit">Guardar Cambios</button>
    </form>

    </div>

    <!-- Formulario con input type file para las fotos-->
   
    <form id="file_{{$habitacion->id_hab}}"  action="{{ route('upload.files.hab', ['id_hab' => $habitacion->id_hab]) }}" method="post" enctype="multipart/form-data" style="display: none;">
        @csrf
        <h3>Sube las fotos y vídeos de tu habitación</h3>
        <input type="file" name="imagenes[]" multiple>
        <div id="image-preview"></div>
        <button type="submit">Subir imágenes</button>
    </form>
 
    <!-- Imprimir imágenes ya insertadas con opción de eliminarlas de la bd -->
   
    <div id="imgs_{{$habitacion->id_hab}}" style="display: none;">
        @foreach($imageneshab as $imagen)
            @if($imagen->id_hab = $habitacion->id_hab)
            <img class="imgs-dashboard" src="{{ asset('habs/' . $imagen->foto) }}" alt="Imagen" width="300px">
            <a href="{{ route('delete.files.hab', ['id_hab' => $habitacion->id_hab, 'foto' => $imagen->foto]) }}">Eliminar</a>
            @endif
        @endforeach
    </div>
   


    @endforeach
</div>

</section>

<script src="{{ URL::asset('resources/js/dashboard.js') }}"></script>

</body>
</html>


