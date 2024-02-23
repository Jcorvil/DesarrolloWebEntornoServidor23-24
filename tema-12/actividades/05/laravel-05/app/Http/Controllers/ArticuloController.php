<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = [
            (object) 
            [
                'id' => 1,
                'descripcion' => 'Portátil HP MD12345',
                'categoria' => 0,
                'stock' => 50,
                'precio_coste' => 550.50,
                'precio_venta' => 750.00
            ],
            (object) 
            [
                'id' => 2,
                'descripcion' => 'Tablet - Samsung Galaxy Tab A (2019)',
                'categoria' => 5,
                'stock' => 100,
                'precio_coste' => 550.50,
                'precio_venta' => 750.00
            ],
            (object) 
            [
                'id' => 3,
                'descripcion' => 'Impresora multifunción - HP',
                'categoria' => 4,
                'stock' => 80,
                'precio_coste' => 250.50,
                'precio_venta' => 420.00
            ],
            (object) 
            [
                'id' => 4,
                'descripcion' => 'TV LED 40" - Thomson 40FE5606 - Full HD',
                'categoria' => 3,
                'stock' => 120,
                'precio_coste' => 200.50,
                'precio_venta' => 400.00
            ],
            (object) 
            [
                'id' => 5,
                'descripcion' => 'PC Sobremesa - Acer Aspire XC-830',
                'categoria' => 1,
                'stock' => 50,
                'precio_coste' => 1000.50,
                'precio_venta' => 1200.00
            ]


        ];

        return view('articulos.articulos', ['articulos' => $articulos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
