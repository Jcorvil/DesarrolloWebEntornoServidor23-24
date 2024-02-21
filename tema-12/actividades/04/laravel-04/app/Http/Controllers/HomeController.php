<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Solo un método
    public function __invoke()
    {

        $alumnos = [
            [
                'id' => 1,
                'nombre' => 'Jorge'
            ],
            [
                'id' => 2,
                'nombre' => 'Jonathan'
            ],
            [
                'id' => 3,
                'nombre' => 'Adri'
            ]
        ];

        $usuarios = [];

        $autor = 'Jorge Coronil Villalba';
        $curso = '23/24';
        $modulo = 'DWES';
        $nivel = 2;

        return view('home.index', compact('autor', 'curso', 'modulo', 'nivel', 'alumnos', 'usuarios'));
    }
}
