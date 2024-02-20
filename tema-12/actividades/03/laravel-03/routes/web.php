<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductoController;

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
    return view('welcome');
});

// Vinculamos cada ruta con un método del controlador
// Route::get('/clientes', [ClientController::class, 'index']);
// Route::get('/clientes/create', [ClientController::class, 'create']);
// Route::get('/clientes/show/{id}', [ClientController::class, 'show']);
// Route::get('/clientes/edit/{id}', [ClientController::class, 'edit']);

// Agrupar todas las rutas del mismo controlador
Route::controller(ClientesController::class)->group(function () {
    Route::get('/clientes', 'index');
    Route::get('/clientes/create', 'create');
    Route::get('/clientes/show/{id}', 'show');
    Route::get('/clientes/update/{id}', 'update');
    Route::get('/clientes/delete/{id}', 'delete');
});

// Generamos las rutas ProductoController creado con --resource
Route::resource('productos', ProductoController::class);


use App\Http\Controllers\AccountController;

Route::controller(AccountController::class)->group(function () {
    Route::get('/cuentas', 'index')->name("cuentas.index");
    Route::get('/cuentas/create', 'create')->name("cuentas.create");
    Route::get('/cuentas/show/{id}', 'show')->name("cuentas.show");
    Route::get('/cuentas/update/{id}', 'update')->name("cuentas.update");
    Route::get('/cuentas/destroy/{id}', 'destroy')->name("cuentas.destroy");
});
