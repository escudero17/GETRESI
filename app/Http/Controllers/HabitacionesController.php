<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\empleados;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class HabitacionesController extends Controller
{
    public function addHabitacion($id_resi){

        // rellenas el hueco de id_usuario
        $token=$_POST['_token'];
        unset($_POST['_token']);

        $habitacion = [];
        $habitacion['nombre'] = $_POST['nombre'];
        $habitacion['descripcion'] = $_POST['descripcion'];
        $habitacion['capacidad'] = $_POST['capacidad'];
        $habitacion['disponibilidad'] = $_POST['disponibilidad'];
        $habitacion['precio'] = $_POST['precio'];
        $habitacion['id_resi'] = $id_resi;

        // db::table-> seleccionar la tabla habitaciones 
        // hace un insert del contenido del formulario que va por post 
        DB::table('habitaciones')->insert($habitacion);





        return redirect()->route('residencia.edit',
         ['id' => $id_resi]);
    }

    public function updateHabitacion($id_hab){

        // rellenas el hueco de id_usuario
        $token=$_POST['_token'];
        unset($_POST['_token']);

        $habitacion = [];
        $habitacion['nombre'] = $_POST['nombre'];
        $habitacion['descripcion'] = $_POST['descripcion'];
        $habitacion['capacidad'] = $_POST['capacidad'];
        $habitacion['disponibilidad'] = $_POST['disponibilidad'];
        $habitacion['precio'] = $_POST['precio'];

        // db::table-> seleccionar la tabla habitaciones 
        // hace un insert del contenido del formulario que va por post 
        DB::table('habitaciones')
        ->where('id_hab', $id_hab)
        ->update($habitacion);

        $hab = DB::table('habitaciones')
        ->where('id_hab', $id_hab)
        ->get();

        return back();
    } 

    public function addCaract(Request $request, $id_hab) {
        // Obtiene todas las características seleccionadas del formulario
        $caracteristicas_seleccionadas = $request->except('_token', '_method');
    
        // Itera sobre cada característica seleccionada
        foreach ($caracteristicas_seleccionadas as $id_cat_habit => $id_caracteristica) {
            // Verifica si la entrada no es el token CSRF (_token)
            if ($id_cat_habit !== '_token') {
                // Verifica si la característica ya está asociada a la habitación
                $caracteristica_existe = DB::table('habitacion_con_caracteristicas')
                    ->where('id_cat_habit', $id_cat_habit)
                    ->where('id_hab', $id_hab)
                    ->exists();
                    
                // Si la característica no está asociada, la inserta
                if (!$caracteristica_existe) {
                    $nueva = [
                        'id_hab' => $id_hab,
                        'id_caracteristica' => $id_caracteristica,
                        'id_cat_habit' => $id_cat_habit
                    ];
                    DB::table('habitacion_con_caracteristicas')->insert($nueva);
                }else{
                    $caracteristica_existente = DB::table('habitacion_con_caracteristicas')
                    ->where('id_cat_habit', $id_cat_habit)
                    ->where('id_hab', $id_hab)
                    ->pluck('id_caracteristica')
                    ->toArray();

                    if($caracteristica_existente[0] != $id_caracteristica){
                        DB::table('habitacion_con_caracteristicas')
                        ->where('id_cat_habit', $id_cat_habit)
                        ->where('id_hab', $id_hab)
                        ->delete();

                        $nueva = [
                            'id_hab' => $id_hab,
                            'id_caracteristica' => $id_caracteristica,
                            'id_cat_habit' => $id_cat_habit
                        ];
                        DB::table('habitacion_con_caracteristicas')->insert($nueva);
                    }
                }

                // Agrega la característica a las seleccionadas
                $caracteristicas_seleccionadas[] = $id_caracteristica;

            }
        }

        return back();
    }



    // -----------------------------------------------------------------------------
public function uploadFiles(Request $request, $id_hab) {
    // Verificar si se han enviado archivos
    if ($request->hasFile('imagenes')) {
        // Iterar sobre cada archivo recibido
        foreach ($request->file('imagenes') as $file) {

            // Generar un nombre único para el archivo
            $nombreArchivo = $file->getClientOriginalName();
            $path = 'habs/';
            $upload = $file->move($path, $nombreArchivo);
    
            // Insertar la URL en la base de datos
            DB::table('habitacion_con_fotos')->insert([
                'id_hab' => $id_hab,
                'foto' => $nombreArchivo
            ]);

        }

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Archivos subidos correctamente.');
    }

    // Redirigir con un mensaje de error si no se seleccionaron archivos
    return redirect()->back()->with('error', 'Por favor seleccione al menos un archivo.');
}

// Función que elimina la imagen seleccionada de la bd
public function deleteImage($id_hab, $foto) {
    
    // Elimina la imagen de la base de datos
    DB::table('habitacion_con_fotos')
    ->where('id_hab', $id_hab)
    ->where('foto', $foto)
    ->delete();
    
    // Redirige de vuelta a la página de edición de residencia
    return redirect()->back()->with('success', 'Imagen eliminada exitosamente.');
}

}
