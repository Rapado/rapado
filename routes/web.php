<?php
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{tipo?}', [InicioController::class, 'bienvenida']);
Route::get('registro/{tipo?}',[InicioController::class, 'registro']);
Route::post('registro',[InicioController::class, 'store'])->name('registro.store');

/*
Route::get('/bienvenida/{nombre?}', function($nombre = 'Viajero'){
    return view('inicio/bienvenida',compact('nombre'));
});*/
