<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\usuarios;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    // Te muestra todas las residencias que tiene el usuario
    public function viewResidencias(){

        $usuario_log = (session('usuario_activo'));
        $residencias=DB::table('residencias')->where('id_usuario',$usuario_log[0]->id_usuario)->get();
        $nombreUsuario = $usuario_log[0]->nombre;

       return view('dashboard', ['residencias' => $residencias, 'nombreUsuario' => $nombreUsuario]);
    }

    // Muestra las solicitudes en "Mis solicitudes"
    public function adminDashboard(){

        $residencia = DB::table('residencias')
        ->where('estado', 'ENTREGADO')
        ->get();
        

        $usuarios = DB::table('usuarios')->get();

        return view('admindashboard',['residencias' => $residencia,'usuarios' => $usuarios]);
    }

    // Aprueba las residencias
    public function approve($id_resi){
        $residencia = DB::table('residencias')
        ->where('id_resi', $id_resi)
        ->update(['estado' => 'ACEPTADO']);

        $residenciaa = DB::table('residencias')
        ->where('estado', 'ENTREGADO')
        ->get();

        $usuarios = DB::table('usuarios')->get();

        // Puedes redirigir a donde desees después de actualizar el estado de la residencia
        return view('admindashboard',['residencias' => $residenciaa,'usuarios' => $usuarios ]);

    }
    public function cancel($id_resi){
        $residencia = DB::table('residencias')
        ->where('id_resi', $id_resi)
        ->update(['estado' => 'RECHAZADO']);

        $residenciaa = DB::table('residencias')
        ->where('estado', 'ENTREGADO')
        ->get();

        $usuarios = DB::table('usuarios')->get();

        // Puedes redirigir a donde desees después de actualizar el estado de la residencia
        return view('admindashboard',['residencias' => $residenciaa,'usuarios' => $usuarios]);

    }
    public function Gr($id)
{
    $usuario =DB::table('usuarios')->where('id_usuario', $id)->first();
    if ($usuario) {
        DB::table('usuarios')->where('id_usuario', $id)->update(['matriculado' => 1]);
    }
    $residenciaa = DB::table('residencias')
    ->where('estado', 'ENTREGADO')
    ->get();

    $usuarios = DB::table('usuarios')->get();

    return view('admindashboard',['residencias' => $residenciaa,'usuarios' => $usuarios]);
}

    public function delete($id){
        // Elimina la imagen de la base de datos
    DB::table('usuarios')
    ->where('id_usuario', $id)
    ->delete();
    
    // Redirige de vuelta a la página de edición de residencia
    return redirect()->back()->with('success', 'Imagen eliminada exitosamente.');
    }





public function dest($id)
{
    $residencia =DB::table('residencias')->where('id_resi', $id)->first();
    if ($residencia) {
        DB::table('residencias')->where('id_resi', $id)->update(['destacada' => 1]);
    }
    $residenciaa = DB::table('residencias')
    ->where('estado', 'ENTREGADO')
    ->get();

    $usuarios = DB::table('usuarios')->get();

    return view('admindashboard',['residencias' => $residenciaa,'residencia' => $residencia]);
}

    // Imprime las residencias aprobadas
    public function residenciasAprobadas(){
        $residenciasAprobadas = DB::table('residencias')
                                ->where('estado', 'ACEPTADO')
                                ->get();
    
        return view('aprobadas', ['residencias' => $residenciasAprobadas]);
    }
}