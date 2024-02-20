<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        return 'Lista Clientes';
    }

    // Crear un cliente
    public function create()
    {
        return 'Nuevo Cliente';
    }

    // Editar un cliente
    public function update($id)
    {
        return "Editar cliente {$id}";
    }

    // Eliminar un cliente
    public function delete($id)
    {
        return "Eliminar cliente {$id}";
    }

    // Mostrar un cliente
    public function show($id)
    {
        return "Cliente: {$id}";
    }


}
