<?php

namespace App\Http\Controllers;
use App\Maquinas;

use Illuminate\Http\Request;

class MaquinasController extends Controller
{
    public function AllMaquinas()
    {
        $maquinas = Maquinas::all();

        return view('Maquinas/todas',[
            'maquinas' => $maquinas
        ]);
    }
}
