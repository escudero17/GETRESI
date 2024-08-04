<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\empleados;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; 
use Illuminate\Http\Request;
use Auth;
use Redirect;

class ResidenciasController extends Controller
{
    public function register()
    {
        return view('register_residencias');
        // muestra residencia.blade.php -> form register
    }

    // ----------------- REGISTRAR UN USUARIO -----------------
    public function storeregister(Request $request)
    {
     /*  'telefono'=>$_POST['telefono'],'apellidos'=>$_POST['apellidos'],'contraseña'=>$_POST['contraseña'],'id_perfil'=>'1','correo'=>'as@as.com','nombre'=>'Pepe'*/
        

     if (session()->has('usuario_activo')) {
        $usuario_log = session('usuario_activo');
        $perfil = $usuario_log[0]->id_perfil;
    } else {
        // Definir un perfil predeterminado o cualquier otra acción que desees tomar si no hay usuario activo
        $perfil = null; // O algún valor predeterminado
    }

    $residencias = DB::table('residencias')->get(); // Obtener todas las residencias
    $residenciasDestacadas = DB::table('residencias')->where('destacada', 1)->where('estado', 'ACEPTADO')->get(); // Obtener las residencias destacadas

    foreach ($residencias as $residencia) {
    // Aquí puedes verificar si la residencia está en las destacadas
    $residencia->destacada = $residenciasDestacadas->contains('id_resi', $residencia->id_resi);
}

        $ciudades = DB::table('ciudades')->get();
        foreach ($ciudades as $ciudad) {
            $num_residencias = DB::table('residencias')->where('id_ciu', $ciudad->id_ciu)->count();
            $ciudad->num_residencias = $num_residencias;
        }


     // rellenas el hueco de id_usuario
       $token=$_POST['_token'];
       unset($_POST['_token']);
       
        $usuario = [];
        $usuario['correo'] = $_POST['correo'];
        $usuario['nombre'] = $_POST['nombre'];
        $usuario['apellidos'] = $_POST['apellidos'];
        $usuario['telefono'] = $_POST['telefono'];
        $usuario['id_perfil'] = 3;
        // encriptas la contraseña 
        $usuario['contraseña']=md5($_POST['contraseña']);

       // db::table-> seleccionar la tabla usuarios 
       // hace un insert del contenido del formulario que va por post 
       DB::table('usuarios')->insert($usuario);

       // hace un select from usuarios where correo=contenido_correo_del_formlario && ''
       // ->get(); sirve para sacar un dato
       $resultado=DB::table('usuarios')->where('correo',$usuario['correo'])->where('contraseña',$usuario['contraseña'])->get();
       
       // genero la sesión y se la envío a index
       Session::put('usuario_activo',$resultado);            
       return view('index',['ciudades' => $ciudades,'perfil' =>$perfil,'residencias' =>$residencias]);
    }

    // ----------------- INSERTAR UNA RESIDENCIA SIN CARACTERÍSTICAS -----------------

    public function formAddResi(){
        return view('inserta_residencia');
    }
    
    public function addResi(Request $request){
       

            // rellenas el hueco de id_usuario
            $token=$_POST['_token'];
            unset($_POST['_token']);
    
            $ubicacion = $request->input('ubicacion');
            $ciuda = $request->input('nombre_ciu');
    
            // sacamos datos del usuario en sesión
            $usuario_log = (session('usuario_activo'));
    
            
    
              // Consultar la API de Google Maps para obtener las coordenadas
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $ubicacion,
            'city' => $ciuda,
            'key' => 'AIzaSyCUwrZUI61eat02XQkJhhPJfGOr3CyKhKE ', // Reemplaza 'TU_API_KEY' con tu clave de API de Google Maps
        ]);
    
        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $data = $response->json();
    
            // Verificar si se encontraron resultados
            if ($data['status'] === 'OK') {
                // Obtener las coordenadas de la primera ubicación encontrada
                $latitud = $data['results'][0]['geometry']['location']['lat'];
                $longitud = $data['results'][0]['geometry']['location']['lng'];
                // Generar código aleatorio de 8 dígitos
                $clave = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
                $residencia = [];
                $residencia['id_usuario'] = $usuario_log[0]->id_usuario;
                $residencia['contenido'] = $request->input('contenido');
                $residencia['nombre_resi'] = $request->input('nombre_resi');
                $residencia['ubicacion'] = $ubicacion;
                $residencia['latitud'] = $latitud;
                $residencia['longitud'] = $longitud;
                $residencia['Clave'] = $clave; // Asignamos el código aleatorio
    
                $ciudad = DB::table('ciudades')->where('nombre_ciu', $request->input('nombre_ciu'))->get();
                    
                $residencia['id_ciu'] = $ciudad[0]->id_ciu;
                $residencia['estado'] = 'ENTREGADO';
    
                // Insertar los datos en la tabla 'residencias'
                DB::table('residencias')->insert($residencia);
    
    
                 
    
                
                
      
    
                return redirect('/');
            } else {
                // Si no se encontraron resultados, puedes manejar el error aquí
                return redirect()->back()->with('error', 'No se encontraron coordenadas para la ubicación proporcionada.');
            }
        } else {
            // Si la solicitud a la API falla, puedes manejar el error aquí
            return redirect()->back()->with('error', 'Hubo un error al consultar la API de Google Maps.');
        }
        }
// Te imprime el formulario con las categorías de la residencia seleccionada
public function editResi($id){
    // Imprimir categorías
    $categoriasresi = DB::select('select * from categoriasresi');

    $caractResi = DB::select('select * from caracteristicasresi');
    
    // Sacar las preguntas de la categoría preguntas frecuentes
    $preguntas = DB::table('preguntas')->get();

    $respuestas = DB::table('residencia_con_preguntas')
    ->join('preguntas', 'residencia_con_preguntas.id_pregunta', '=', 'preguntas.id_pregunta')
    ->get();

    // Obtener las características seleccionadas previamente
    $residencia_caracteristicas = DB::table('residencia_con_caracteristicas')
        ->where('id_resi', $id)
        ->pluck('id_caracteristica')
        ->toArray();

    // Obtener las imágenes asociadas a la residencia
    $imagenes = DB::table('residencia_con_fotos')
    ->where('id_resi', $id)
    ->get();

    //Obtener las habitaciones asociadas a la residencia
    $habitaciones = DB::table('habitaciones')
    ->where('id_resi', $id)
    ->get();

    $categoriashab = DB::table('categoriashab')
    ->get();

    $caracteristicashab = DB::table('caracteristicashab')
    ->get();

    // Obtener las imágenes asociadas a la habitacion
    $imageneshab = DB::table('habitacion_con_fotos')
    ->get();

    return view('form_residencia', [
        'categorias' => $categoriasresi,
        'caracteristicas' => $caractResi,
        'id' => $id,
        'preguntas' => $preguntas, 
        'residencia_caracteristicas' => $residencia_caracteristicas,
        'respuestas' => $respuestas,
        'imagenes' => $imagenes,
        'habitaciones' => $habitaciones,
        'categoriashab' => $categoriashab,
        'caracteristicashab' => $caracteristicashab,
        'imageneshab' => $imageneshab,
    ]);
}

    // ------------------------------------------------------------------------------------------------------------------

    // Te inserta las características de una categoría
    public function addCaract($id_resi) {

        // Esto nos ayuda a que no salte un token
        $token = $_POST['_token'];
        unset($_POST['_token']);
        
        //Array para almacenar las nuevas características seleccionadas
        $caracteristicas_seleccionadas = [];
    
        // Itera sobre cada característica seleccionada
        foreach ($_POST as $id => $value) {
                // Verifica si la característica ya está asociada a la residencia
                $caracteristica_existente = DB::table('residencia_con_caracteristicas')
                    ->where('id_caracteristica', $id)
                    ->where('id_resi', $id_resi)
                    ->exists();
                    
                // Si la característica no está asociada, la inserta
                if (!$caracteristica_existente) {
                    $nueva = [
                        'id_resi' => $id_resi,
                        'id_caracteristica' => $id
                    ];
                    DB::table('residencia_con_caracteristicas')->insert($nueva);
                }
      
                // Agrega la característica a las seleccionadas
                $caracteristicas_seleccionadas[] = $id;
    
                $id_cat = DB::table('caracteristicasresi')
                ->where('id_caracteristica', $id)
                ->pluck('id_cat_resi')
                ->toArray();
            
        }
    
        // Obtiene todas las características asociadas a esta residencia
        $caracteristicas_existentes = DB::table('residencia_con_caracteristicas')
        ->join('caracteristicasresi', 'residencia_con_caracteristicas.id_caracteristica', '=', 'caracteristicasresi.id_caracteristica')
        ->where('residencia_con_caracteristicas.id_resi', $id_resi)
        ->where('caracteristicasresi.id_cat_resi', $id_cat[0])
        ->pluck('residencia_con_caracteristicas.id_caracteristica')
        ->toArray();
    
        // Elimina las características deseleccionadas
        $caracteristicas_a_eliminar = array_diff($caracteristicas_existentes, $caracteristicas_seleccionadas);
        if (!empty($caracteristicas_a_eliminar)) {
            DB::table('residencia_con_caracteristicas')
                ->where('id_resi', $id_resi)
                ->whereIn('id_caracteristica', $caracteristicas_a_eliminar)
                ->delete();
        }
    
            // Redirige de vuelta a la página de edición de residencia
            return redirect()->route('residencia.edit', ['id' => $id_resi]);
    }

// -------------------------------------------------------------------------------------------
    
public function AddPregunta(Request $request, $id_resi) {
    // Obtener todas las respuestas enviadas en la solicitud
    $respuestas = $request->except('_token');
    // Obtener el ID de la residencia desde la solicitud
    $id_resi = $request->route('id_resi');

    foreach ($respuestas as $id_pregunta => $respuesta) {
        // Verificar si la respuesta está presente y no es nula o vacía
        if ($request->filled($id_pregunta)) {
            // Verifica si la pregunta ya está asociada a la residencia
            $pregunta_existente = DB::table('residencia_con_preguntas')
                ->where('id_pregunta', $id_pregunta)
                ->where('id_resi', $id_resi)
                ->exists();
                
            // Si la pregunta ya está asociada, actualiza la respuesta
            if ($pregunta_existente) {
                DB::table('residencia_con_preguntas')
                    ->where('id_pregunta', $id_pregunta)
                    ->where('id_resi', $id_resi)
                    ->update(['respuesta' => $respuesta]);
            } else {
                // Si la pregunta no está asociada, la inserta
                $nueva = [
                    'id_resi' => $id_resi,
                    'respuesta' => $respuesta,
                    'id_pregunta' => $id_pregunta
                ];
                DB::table('residencia_con_preguntas')->insert($nueva);
            }
        }
    }

    // Redirigir al dashboard
    return redirect()->route('residencia.edit',  ['id' => $id_resi]);
}

// Sirve para el update de preguntas y respuestas
public function eliminarRespuesta(Request $request) {
    $id_pregunta = $request->input('id_pregunta');
    // Elimina la respuesta asociada a la pregunta
    DB::table('residencia_con_preguntas')
        ->where('id_pregunta', $id_pregunta)
        ->delete();

    return redirect()->route('residencia.edit',  ['id' => $id_resi]);
}


// -----------------------------------------------------------------------------
public function uploadMainFiles(Request $request, $id_resi) {
    // Verificar si se han enviado archivos
    if ($request->hasFile('imagenes')) {
        // Iterar sobre cada archivo recibido
        foreach ($request->file('imagenes') as $file) {

            // Generar un nombre único para el archivo
            $nombreArchivo = $file->getClientOriginalName();
            $path = 'imgs/';
            $upload = $file->move($path, $nombreArchivo);
    
            // Insertar la URL en la base de datos
            DB::table('residencia_con_fotos')->insert([
                'id_resi' => $id_resi,
                'foto' => $nombreArchivo,
                'fotos_principales' => 1
            ]);

        }

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Archivos subidos correctamente.');
    }

    // Redirigir con un mensaje de error si no se seleccionaron archivos
    return redirect()->back()->with('error', 'Por favor seleccione al menos un archivo.');
}
public function uploadFiles(Request $request, $id_resi) {
    // Verificar si se han enviado archivos
    if ($request->hasFile('imagenes')) {
        // Iterar sobre cada archivo recibido
        foreach ($request->file('imagenes') as $file) {

            // Generar un nombre único para el archivo
            $nombreArchivo = $file->getClientOriginalName();
            $path = 'imgs/';
            $upload = $file->move($path, $nombreArchivo);
    
            // Insertar la URL en la base de datos
            DB::table('residencia_con_fotos')->insert([
                'id_resi' => $id_resi,
                'foto' => $nombreArchivo,
                'fotos_principales' => 0
            ]);

        }

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Archivos subidos correctamente.');
    }

    // Redirigir con un mensaje de error si no se seleccionaron archivos
    return redirect()->back()->with('error', 'Por favor seleccione al menos un archivo.');
}

// Función que elimina la imagen seleccionada de la bd
public function deleteImage($id_resi, $foto) {
    
    // Elimina la imagen de la base de datos
    DB::table('residencia_con_fotos')
    ->where('id_resi', $id_resi)
    ->where('foto', $foto)
    ->delete();
    
    // Redirige de vuelta a la página de edición de residencia
    return redirect()->back()->with('success', 'Imagen eliminada exitosamente.');
}


// Imprime la residencia seleccionada
public function verResidencia($id_resi){
    // Obtener los datos de la residencia
    $residencia = DB::table('residencias')->where('id_resi', $id_resi)->first();
    if (session()->has('usuario_activo')) {
        $usuario_log = session('usuario_activo');
        $perfil = $usuario_log[0]->id_perfil;
    } else {
        // Definir un perfil predeterminado o cualquier otra acción que desees tomar si no hay usuario activo
        $perfil = null; // O algún valor predeterminado
    }
     // Obtener las coordenadas de la residencia
     $latitud = $residencia->latitud;
     $longitud = $residencia->longitud;
 
    // Obtener las habitaciones de la residencia
    $habitaciones = DB::table('habitaciones')->where('id_resi', $id_resi)->get();

    $preguntas = DB::table('preguntas')->get();

    $respuestas = DB::table('residencia_con_preguntas')
        ->where('id_resi', $id_resi)
        ->get();


    $fotos_principales = DB::table('residencia_con_fotos')
    ->where('id_resi', $id_resi)
    ->where('fotos_principales', 1) // Filtrar fotos principales
    ->take(1) // Que solo se me imprima 1
    ->get()
    ->toArray();
    $fotos_carrusel = DB::table('residencia_con_fotos')
    ->where('id_resi', $id_resi)
    ->get()
    ->toArray();
    $fotos = DB::table('residencia_con_fotos')
    ->where('id_resi', $id_resi)
    ->where('fotos_principales', 0) // Filtrar fotos principales
    ->take(4) // Cambia 5 por el número de fotos que deseas obtener
    ->get()
    ->toArray();
    
    $residenciasDestacadas = DB::table('residencias')
    ->where('destacada', 1)
    ->where('estado', 'ACEPTADO')
    ->get();
    // Verificar si la residencia existe
    if ($residencia) {
        // Cargar la vista residencia.blade.php y pasar los datos de la residencia
        return view('residencia', ['residencia' => $residencia, 
                    'perfil' =>$perfil,
                    'residenciasDestacadas' => $residenciasDestacadas,
                    'habitaciones' => $habitaciones,
                    'preguntas' => $preguntas,'respuestas' => $respuestas,
                    'fotos'=>$fotos,'fotos_principales'=>$fotos_principales,
                    'fotos_carrusel'=>$fotos_carrusel, 'preguntas'=>$preguntas,
                    'respuestas'=>$respuestas, 'latitud' => $latitud,
                    'longitud' => $longitud]);
    } else {
        // Si la residencia no existe, redirigir a alguna página de error o manejarlo según tu lógica de negocio
        // Por ejemplo, redirigir de vuelta a la página de inicio
        return redirect()->route('ciudad')->with('error', 'La residencia seleccionada no existe.');
    }
}


// public function filtrarResidencias(Request $request)
// {
//     $caracteristicas = $request->input('caracteristica'); // Obtener las características seleccionadas

//     // Consulta SQL para obtener las residencias que tienen las características seleccionadas
//     $residencias = DB::table('residencias')
//                     ->join('residencia_con_caracteristicas', 'residencias.id_resi', '=', 'residencia_con_caracteristicas.id_resi')
//                     ->whereIn('residencia_con_caracteristicas.id_caracteristica', $caracteristicas)
//                     ->get();

//                     return response()->json($residencias); // Devolver las residencias filtradas como respuesta JSON
//                 }catch (\Exception $e) {
//                     Log::error('Error en el controlador de filtrarResidencias: ' . $e->getMessage());
//                     return response()->json(['error' => 'Error interno del servidor'], 500); // Devolver un mensaje de error como respuesta JSON
//                 }



 }
// -------------------------------------------------------------------------------------------------------------------------    

