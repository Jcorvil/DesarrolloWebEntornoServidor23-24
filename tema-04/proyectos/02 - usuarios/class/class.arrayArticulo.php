<?php
/*
    class.arrayArticulos.php

    tabla de articulos

    Es un array donde cada elemento es un objeto de la clase Articulo
*/

class ArrayArticulos
{
    private $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }


    /**
     * @return mixed
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * @param mixed $tabla 
     * @return self
     */
    public function setTabla($tabla): self
    {
        $this->tabla = $tabla;
        return $this;
    }


    static public function getMarcas()
    {
        $marcas = [
            'Xiaomi',
            'Acer',
            'Aoc',
            'Nokia',
            'Apple',
            'Lenovo',
            'IBM'
        ];

        asort($marcas);

        return $marcas;
    }

    static public function getCategorias()
    {
        $categorias = [
            'Portátiles',
            'PCs Sobremesa',
            'Componentes',
            'Pantallas',
            'Impresoras',
            'Tablets',
            'Móviles',
            'Fotografía',
            'Imagen'
        ];

        asort($categorias);

        return $categorias;
    }


    public function getDatos()
    {
        #Articulo 1
        $articulo = new Articulo(
            1,
            'Portátil - HP 15-D00774NS',
            'HP 15-DB0074NS',
            0,
            [2, 3, 5],
            120,
            379
        );
        #Añadir articulo a la tabla
        $this->tabla[] = $articulo;

        #Articulo 2
        $articulo = new Articulo(
            2,
            'Portátil - AMD A4-9125, 8GB RAM, 125GB',
            'HP 255 G7, 15.6',
            0,
            [2, 3, 5],
            200,
            550.50
        );
        $this->tabla[] = $articulo;

        # Articulo 3
        $articulo = new Articulo(
            3,
            'Móvil - iPhone 13 Pro',
            'Apple iPhone 13 Pro',
            5,
            [1, 2, 7],
            30,
            1099
        );
        $this->tabla[] = $articulo;

        # Articulo 4
        $articulo = new Articulo(
            4,
            'Tablet - Samsung Galaxy Tab S7',
            'Samsung Galaxy Tab S7',
            4,
            [3, 6],
            20,
            649
        );
        $this->tabla[] = $articulo;

        # Articulo 5
        $articulo = new Articulo(
            5,
            'Pantalla - ASUS ProArt PA279Q',
            'ASUS ProArt PA279Q',
            5,
            [4, 5],
            15,
            699
        );
        $this->tabla[] = $articulo;

        # Articulo 6
        $articulo = new Articulo(
            6,
            'Componente - NVIDIA GeForce RTX 3080',
            'NVIDIA GeForce RTX 3080',
            5,
            [5, 8],
            10,
            799
        );
        $this->tabla[] = $articulo;

    }


    static public function mostrarCategorias($categorias, $categoriasArticulo)
    {
        $arrayCategorias = [];

        foreach ($categoriasArticulo as $indiceCategoria) {
            $arrayCategorias[] = $categorias[$indiceCategoria];
        }

        asort($arrayCategorias);
        return $arrayCategorias;

    }


    public function create(Articulo $data) {
        $this->tabla[] = $data;
    }

    public function delete ($indice) {
        unset($this->tabla[$indice]);
        array_values($this->tabla);
    }

}

?>