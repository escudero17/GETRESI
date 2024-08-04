<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidenciasController;
use App\Http\Controllers\BeneficiosController;
use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|       RUTAS -> CONTROLADOR -> VISTAS
*/

// ------------------- PÁGINA PRINCIPAL --------------------
Route::get('/mapa', function () {
    return view('mapa');
});
Route::get('/', [UsuarioController::class, 'index']); 

Route::post('buscarCiudad', [UsuarioController::class, 'find'])->name('findByName'); 

Route::get('buscar/{nombre_ciudad}', [UsuarioController::class, 'buscarPorCiudad'])->name('buscarPorCiudad');

// ------------------- DESCARGAR PDF --------------------

Route::get('/descargar-pdf', function () {
    $file = public_path() . '/pdf/documento.pdf';
    $headers = array(
        'Content-Type: application/pdf',
    );
    return Response::download($file, 'documento.pdf', $headers);
})->name('descargar.pdf');

// ------------------- USUARIO CONTROLLER --------------------

// Imprime el form register
Route::get('/register', [UsuarioController::class, 'register']);
// Inserta un usuario
Route::post('/register', [UsuarioController::class, 'storeregister']);

// Imprime el form login
Route::get('/login', [UsuarioController::class, 'formlogin']);
// Realiza el login
Route::post('/login', [UsuarioController::class, 'storelogin']);

// Cerrar sesión
Route::get('/logout', [UsuarioController::class, 'logout']);

// Acceder a "Mi cuenta"
Route::get('/miCuenta', [UsuarioController::class, 'miCuenta'])->name('miCuenta');

// Hacer update de los datos del usuario
Route::post('/actualizar-usuario', [UsuarioController::class, 'actualizarUsuario'])->name('actualizarUsuario');

// ------------------- DASHBOARD CONTROLLER --------------------

// Te lleva a la vista del dashboard 
Route::get('/dashboard', [DashboardController::class, 'viewResidencias']);

// Te lleva al dashboard de gr
Route::get('/admindashboard', [DashboardController::class, 'adminDashboard']);

// Aceptar una solicitud
Route::post('/aceptarResi/{id_resi}', [DashboardController::class, 'approve'])->name('residencia.aceptar');
// Rechazar una solicitud
Route::post('/cancelarResi/{id_resi}', [DashboardController::class, 'cancel'])->name('cancel');
//  Matricula a un usuario (GR)
Route::post('/matricular-usuario/{id}', [DashboardController::class, 'Gr'])->name('matricularUsuario');
//  Elimina a un usuario 
Route::delete('/eliminarUsuario/{id}', [DashboardController::class, 'delete'])->name('eliminarUsuario');
//  Destaca una residencia
Route::post('/destacarResi/{id}', [DashboardController::class, 'dest'])->name('destacar');

// Imprimir las residencias aprobadas 
Route::get('/residencias/aprobadas', 'DashboardController@residenciasAprobadas')->name('residencias.aprobadas');

// Imprimir los usuarios logados
Route::get('/usuarios-registrados', [UsuarioController::class, 'mostrarUsuarios']);

// ------------------- CIUDAD CONTROLLER --------------------

// Imprime las ciudades por nombre de la ciudad
Route::get('/ciudades', [CiudadController::class, 'imprimirCiudad']);

// Imprime la pantalla de la residencia seleccionada 
Route::get('/ver-residencia/{id_resi}', [ResidenciasController::class, 'verResidencia']);

Route::post('/filtResi', [ResidenciasController::class, 'filtrarResidencias'])->name('filtResi');

// ------------------- BENEFICIOS CONTROLLER --------------------

// Imprime la pantalla de beneficios
Route::get('/beneficios', function(){
    $usuario_log = (session('usuario_activo'));
    $claves = DB::table('residencias')->pluck('Clave')->map('trim')->toArray();
    if (session()->has('usuario_activo')) {
        $usuario_log = session('usuario_activo');
        $perfil = $usuario_log[0]->id_perfil;
    } else {
        // Definir un perfil predeterminado o cualquier otra acción que desees tomar si no hay usuario activo
        $perfil = null; // O algún valor predeterminado
    }
    // $beneficio = DB::table('tipo_beneficio')->get();

    return view('beneficios',['Clave' => $claves,'perfil' =>$perfil ]);
    // , 'tipo_beneficios' => $tipo_beneficios  
});

// ------------------- RESIDENCIAS CONTROLLER --------------------

// Imprime el form register de una cuenta tipo: residencia
Route::get('/residencias', [ResidenciasController::class, 'register']);
// Inserta un usuario de una cuenta tipo: residencia
Route::post('/residencias', [ResidenciasController::class, 'storeregister']);

//Imprime form insertar residencias 
Route::get('/add',[ResidenciasController::class, 'formAddResi']);
// Inserta una residencia 
Route::post('/addResi', [ResidenciasController::class, 'addResi']);

// Imprime el formulario para rellenar las caracteristicas de la residencia
Route::get('editResi/{id}', [ResidenciasController::class, 'editResi'])->name('residencia.edit');
// Guarda el formulario de una categoría de la residencia
Route::post('addCaract/{id_resi}', [ResidenciasController::class, 'addCaract'])->name('caracteristica.add');

// Guarda las respuesta introducidas en la categoría "preguntas frecuentes" del form_residencia.blade.php
Route::post('AddPregunta/{id_resi}', [ResidenciasController::class, 'AddPregunta'])->name('pregunta.add');

// Subir archivos PRINCIPALES (fotos y vídeos) en el formulario de inserción de residencias
Route::post('/uploadResifiles/{id_resi}', [ResidenciasController::class, 'uploadMainFiles'])->name('upload.main.files');

// Subir archivos RESTANTES (fotos y vídeos) en el formulario de inserción de residencias
Route::post('/upload-files/{id_resi}', [ResidenciasController::class, 'uploadFiles'])->name('upload.files');

// Eliminar foto definida
Route::get('/delete-files/{id_resi}/{foto}', [ResidenciasController::class, 'deleteImage'])->name('delete.files');

// ------------------- HABITACIONES CONTROLLER --------------------

// Guarda las respuesta introducidas en la categoría "preguntas frecuentes" del form_residencia.blade.php
Route::post('addHabitacion/{id_resi}', [HabitacionesController::class, 'addHabitacion'])->name('habitaciones.add');

// Guarda las respuesta introducidas en la categoría "preguntas frecuentes" del form_residencia.blade.php
Route::post('addHabitacionCaracteristica/{id_hab}', [HabitacionesController::class, 'addCaract'])->name('habitaciones.caracteristicas');

// Guarda las respuesta introducidas en la categoría "preguntas frecuentes" del form_residencia.blade.php
Route::post('updateHabitacion/{id_hab}', [HabitacionesController::class, 'updateHabitacion'])->name('habitaciones.update');

// Subir archivos (fotos y vídeos) en el formulario de inserción de residencias
Route::post('/uploadHabFiles/{id_hab}', [HabitacionesController::class, 'uploadFiles'])->name('upload.files.hab');
// Eliminar foto definida
Route::get('/deleteHabFiles/{id_hab}/{foto}', [HabitacionesController::class, 'deleteImage'])->name('delete.files.hab');

// ------------------- CORREO CONTROLLER --------------------

// Envía el correo Contáctanos
Route::post('sendEmail', [MailController::class, 'sendEmail'])->name('send.email');
Route::post('/send-reserva-email', [MailController::class, 'sendReservaEmail'])->name('sendReservaEmail');
