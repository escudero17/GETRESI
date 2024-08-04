<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\empleados;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class BeneficiosController extends Controller
{
    public function index()
    {
        return view('beneficios');
        // muestra beneficios.blade.php
    }

}

