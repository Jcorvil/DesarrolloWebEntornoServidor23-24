<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return "Jorge Coronil Villalba, DWESE, 2ºDAW, Prueba";
});

Route::get('/api/user', function () {
    return 'No temo a los ordenadores; lo que temo es quedarme sin ellos -- Isaac Asimov';
});


// Route::get('/user/{nombre}/{apellidos}', function ($nombre, $apellidos) {
//     return "{$nombre} {$apellidos}";
// });

// ----------IMPORTANTE----------
// Los métodos dan conflicto porque se llaman igual. Si pones /user/view/1 va a imprimir el método de arriba porque piensa que
// "view" es el nombre y "id" es el apellido

// Route::get('/user/view/{$id?}', function ($id = null) {
//     return "Usuario: {$id}";
// });

Route::get('/user/mostrar/{id1}/{id2?}', function ($id1, $id2 = null) {
    if (!$id2)
        return "Dato {$id1}";
    else
        return "Datos {$id1} y {$id2}";
});