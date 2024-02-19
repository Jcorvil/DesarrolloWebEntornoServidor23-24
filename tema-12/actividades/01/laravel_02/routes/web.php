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

Route::get('/', function () {
    return 'Hola mundo Laravel 10';
    // return view('welcome');
});


Route::get('/client', function () {
    return 'Vista principal de clientes';
});


Route::get('/client/edit/{id}', function ($id) {
    // return "Cliente Editado: {$id}";
    return "Cliente Editado: 5";
});


Route::get('/client/show/{id}', function ($id) {
    // return "Mostrando el cliente {$id}";
    return "Mostrando el cliente 5";
});


Route::get('/client/new/', function () {
    return "Creando el cliente";
});


// Al poner '?' se convierte el parámetro en opcional. Se debe establecer que el parámetro opcional es null por defecto. 
Route::get('/client/delete/{id1}/{id2?}', function ($id1, $id2 = null) {
    if (!$id2)
        // return "Eliminar el cliente {$id1}";
        return "Eliminar el cliente 1";
    else
        // return "Eliminar los clientes del {$id1} al {$id2}";
        return "Eliminar los clientes del 1 al 2";
});