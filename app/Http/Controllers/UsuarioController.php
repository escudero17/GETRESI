<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\empleados;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use Redirect;

class UsuarioController extends Controller
{
    public function index()
    {
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
            
            $num_residencias = DB::table('residencias')
                            ->where('id_ciu', $ciudad->id_ciu)
                            ->where('estado', 'ACEPTADO')
                            ->count();
            $ciudad->num_residencias = $num_residencias;
        }

        return view('index', ['ciudades' => $ciudades,'perfil' =>$perfil,'residencias' =>$residencias]);
        // muestra index.blade.php -> pantalla principal

    }

    public function register()
    {
        return view('register');
        // muestra register.blade.php -> form register
    }
    public function ciudad()
    {
        return view('ciudad');
      
    }

    public function formlogin(){

        return view('login');
        // muestra login.blade.php -> form login


    }


    // ----------------- BUSCAR -----------------   


    public function find(Request $request){

        if (session()->has('usuario_activo')) {
            $usuario_log = session('usuario_activo');
            $perfil = $usuario_log[0]->id_perfil;
        } else {
            // Definir un perfil predeterminado o cualquier otra acción que desees tomar si no hay usuario activo
            $perfil = null; // O algún valor predeterminado
        }
        
        $nombre_ciudad = $request->input('query');
    
        // Buscar la ciudad por su nombre
        $ciudad = DB::table('ciudades')->where('nombre_ciu', $nombre_ciudad)->first();
        $categorias = DB::table('categoriasresi')->get();
        $caracteristicas = DB::table('caracteristicasresi')->get();
     // Enviar una solicitud a la API de Geocodificación de Google Maps
     $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
        'address' => $nombre_ciudad,
         'key' => 'AIzaSyCUwrZUI61eat02XQkJhhPJfGOr3CyKhKE' 
            ]);
            // defino las latitudes de madrid por si el usuario escribe "dkfsjf" que le redirija a madrid (línea 100)
            $latitud = 40.4168;
            $longitud = -3.7038;
        // Verificar si la solicitud fue exitosa y si se obtuvieron resultados
        if ($response->successful() && $response['status'] === 'OK') {
         // Obtener las coordenadas de la ciudad desde la respuesta
        $latitud = $response['results'][0]['geometry']['location']['lat'];
         $longitud = $response['results'][0]['geometry']['location']['lng'];
        } else {
        // Manejar el caso en el que no se pudo obtener la información de la ciudad
        return redirect()->route('buscarPorCiudad', ['nombre_ciudad' => 'Madrid', 'latitud' => $latitud,'perfil' =>$perfil,'longitud' => $longitud]);
    }
        if($ciudad){
            // Si se encontró la ciudad, buscar las residencias con el mismo id_ciu
            $residenciasDestacadas = DB::table('residencias')->where('id_ciu', $ciudad->id_ciu)->where('destacada', 1)->get();
            $residenciasNoDestacadas = DB::table('residencias')->where('id_ciu', $ciudad->id_ciu)->where('destacada', 0)->get();
            
            // Fusionar las residencias destacadas y no destacadas
            $residencias = $residenciasDestacadas->merge($residenciasNoDestacadas);
            
            return view('ciudad', ['residencias' => $residencias, 'ciudad' => $nombre_ciudad,'perfil' =>$perfil, 'categorias' => $categorias, 'caracteristicasresi' => $caracteristicas, 'latitud' => $latitud,'longitud' => $longitud]);
        } else {
            // Si no se encontró la ciudad, redirigir a la página de Madrid
            return redirect()->route('buscarPorCiudad', ['nombre_ciudad' => 'Madrid', 'latitud' => $latitud,'perfil' =>$perfil,'longitud' => $longitud]);
        }
    }


    public function buscarPorCiudad($nombre_ciudad)
{
   
// Enviar una solicitud a la API de Geocodificación de Google Maps
$response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
    'address' => $nombre_ciudad,
    'key' => 'AIzaSyCUwrZUI61eat02XQkJhhPJfGOr3CyKhKE' 
]);
if (session()->has('usuario_activo')) {
    $usuario_log = session('usuario_activo');
    $perfil = $usuario_log[0]->id_perfil;
} else {
    // Definir un perfil predeterminado o cualquier otra acción que desees tomar si no hay usuario activo
    $perfil = null; // O algún valor predeterminado
}
// Verificar si la solicitud fue exitosa y si se obtuvieron resultados
if ($response->successful() && $response['status'] === 'OK') {
    // Obtener las coordenadas de la ciudad desde la respuesta
    $latitud = $response['results'][0]['geometry']['location']['lat'];
    $longitud = $response['results'][0]['geometry']['location']['lng'];
} else {
    // Manejar el caso en el que no se pudo obtener la información de la ciudad
    return redirect()->route('error');
}



    // Buscar la ciudad por su nombre
    $ciudad = DB::table('ciudades')->where('nombre_ciu', $nombre_ciudad)->first();



    $categorias = DB::table('categoriasresi')->get();

    $caracteristicas = DB::table('caracteristicasresi')->get();

    $residenciasDestacadas = DB::table('residencias')->where('id_ciu', $ciudad->id_ciu)->where('destacada', 1)->where('estado', 'ACEPTADO')->get();
    $residenciasNoDestacadas = DB::table('residencias')->where('id_ciu', $ciudad->id_ciu)->where('destacada', 0)->where('estado', 'ACEPTADO')->get();
    
    // Fusionar las residencias destacadas y no destacadas
    $residencias = $residenciasDestacadas->merge($residenciasNoDestacadas);
    

    return view('ciudad', [
        'residencias' => $residencias,
        'perfil' =>$perfil,
        'ciudad' => $nombre_ciudad,
        'latitud' => $latitud,
        'longitud' => $longitud,
        'categorias' => $categorias,
        'caracteristicasresi' => $caracteristicas
    ]);
}


// ----------------- INCIAR SESIÓN DE UN USUARIO -----------------

    public function storelogin(){

        $token=$_POST['_token'];
        unset($_POST['_token']); // por qué lo unsetea
       
        $_POST['contraseña']=md5($_POST['contraseña']); // encripta la contraseña recibida
       
    $residencias = DB::table('residencias')->get(); // Obtener todas las residencias
    $residenciasDestacadas = DB::table('residencias')->where('destacada', 1)->where('estado', 'ACEPTADO')->get(); // Obtener las residencias destacadas

    foreach ($residencias as $residencia) {
    // Aquí puedes verificar si la residencia está en las destacadas
    $residencia->destacada = $residenciasDestacadas->contains('id_resi', $residencia->id_resi);
}
        // hace un select from usuarios where correo=contenido_correo_del_formlario && ''
        // ->get(); sirve para sacar un dato
        $resultado=DB::table('usuarios')->where('correo',$_POST['correo'])->where('contraseña',$_POST['contraseña'])->get();
        
        $ciudades = DB::table('ciudades')->get();
        foreach ($ciudades as $ciudad) {
            $num_residencias = DB::table('residencias')->where('id_ciu', $ciudad->id_ciu)->count();
            $ciudad->num_residencias = $num_residencias;
        }
        // si el usuario existe o no + si la contraseña es igual o no
        if(count($resultado)==1){
            Session::put('usuario_activo',$resultado);
            $usuario_log = session('usuario_activo');
            $perfil = $usuario_log[0]->id_perfil;
            return view('index', $resultado, ['ciudades' => $ciudades,'perfil'=>$perfil,'residencias'=>$residencias]);

            // Obtenemos el perfil del usuario actual
            $perfil = $resultado["id_perfil"];

            // Te aplica los dashboards dependiendo del rol (estudiante,empresa,GR) que tenga el estudiante


        }else{
            return redirect()->back()->withInput()->withErrors(['contraseña' => 'Contraseña incorrecta']);
        } 

    } 

// ----------------- REGISTRAR UN USUARIO -----------------
     public function storeregister(Request $request)
     {
        $datosFormulario = $request->all();

        // rellenas el hueco de id_usuario
        $token=$datosFormulario['_token'];
        unset($datosFormulario['_token']);
     
 
         // Verificar si las contraseñas coinciden
     if ($datosFormulario['contraseña'] !== $datosFormulario['confirmar_contraseña']) {
         // Las contraseñas no coinciden, redirigir de vuelta al formulario con un mensaje de error
         return redirect()->back()->withInput()->withErrors(['confirmar_contraseña' => 'Las contraseñas no coinciden']);
 }
 
 $datosFormulario = $request->except('_token', 'confirmar_contraseña');
     
     // Encriptar la contraseña
     $datosFormulario['contraseña'] = md5($datosFormulario['contraseña']);

     $datosFormulario['id_perfil'] = 2;

     // Insertar los datos del formulario en la tabla 'usuarios'
     DB::table('usuarios')->insert($datosFormulario);

     // hace un select from usuarios where correo=contenido_correo_del_formlario && ''
     // ->get(); sirve para sacar un dato
     $resultado=DB::table('usuarios')->where('correo', $datosFormulario['correo'])->where('contraseña',$datosFormulario['contraseña'])->get();
     

     $residencias = DB::table('residencias')->get(); // Obtener todas las residencias
     $residenciasDestacadas = DB::table('residencias')->where('destacada', 1)->get(); // Obtener las residencias destacadas
 
     foreach ($residencias as $residencia) {
     // Aquí puedes verificar si la residencia está en las destacadas
     $residencia->destacada = $residenciasDestacadas->contains('id_resi', $residencia->id_resi);
 }

     $ciudades = DB::table('ciudades')->get();
      foreach ($ciudades as $ciudad) {
     $num_residencias = DB::table('residencias')->where('id_ciu', $ciudad->id_ciu)->count();
     $ciudad->num_residencias = $num_residencias;
 }

     // genero la sesión y se la envío a index
     Session::put('usuario_activo',$resultado);   
     $usuario_log = (session('usuario_activo'));
     $perfil = $usuario_log[0]->id_perfil;         
     return view('index',['perfil' =>$perfil,'ciudades' => $ciudades,'residencias'=>$residencias]);
     }

// ----------------- CERRAR SESIÓN -----------------

    public function logout()
    {
        session()->flush();
        return Redirect::to('/');
    }

// ----------------- ACCEDER A "MI CUENTA" -----------------

    public function miCuenta(){
        $usuario_log = session('usuario_activo');
        // Verificar si hay un usuario activo en la sesión
        if(isset($usuario_log)) {
            // Obtener los datos del usuario
            $usuario = $usuario_log[0];
            // Pasar los datos del usuario a la vista
            return view('miCuenta', ['usuario' => $usuario]);
        } else {
            // Si no hay un usuario activo en la sesión, redirigir a algún lugar
            return redirect()->back()->with('error', 'No hay un usuario activo');
        }
    }

    // Haces el update con los datos de "Mi cuenta"
    public function actualizarUsuario(Request $request) {
        // Obtener los datos del usuario de la solicitud
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');

        // Obtener el ID del usuario activo
        $usuarioLog = session('usuario_activo');
        $idUsuario = $usuarioLog[0]->id_usuario;

        // Actualizar los datos del usuario en la base de datos
        DB::table('usuarios')
            ->where('id_usuario', $idUsuario)
            ->update([
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'telefono' => $telefono
            ]);

        // Redirigir al usuario de regreso a su página de cuenta
        return redirect()->route('miCuenta')->with('success', 'Los cambios se han guardado correctamente.');
        //return redirect()->route('miCuenta')->with('success', 'Los cambios se han guardado correctamente.');
    }

    // Imprimes todos los usuarios registrados en el botón "Usuarios" del admin dashboard
    public function mostrarUsuarios()
    {
        $usuarios = DB::table('usuarios')->get();
        return view('admindashboard', ['usuarios' => $usuarios]);
    }
}