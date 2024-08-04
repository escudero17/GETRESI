<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function imprimirCiudad()
    {
        $ciudades = Ciudad::all();
        return view('ciudad', ['ciudades' => $ciudades]);
    }
}
