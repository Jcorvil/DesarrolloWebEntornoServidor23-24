<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{


    public function index()
    {
        return "Cuenta";
    }

    public function create()
    {
        return "Creación de la cuenta";

    }

    public function show($id)
    {
        return "Mostrar la cuenta {$id}";

    }
    
    public function update($id)
    {
        return "Editar la cuenta {$id}";
        
    }
    
    public function destroy($id)
    {
        return "Cuenta {$id} eliminada";

    }

}


?>