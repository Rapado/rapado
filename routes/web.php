<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiaDeTrabajoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PeluqueriaController;
use App\Http\Controllers\PeluqueroController;
use App\Http\Controllers\ServicioController;
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


Route::get('/',  [InicioController::class, 'clienteWelcome'])->middleware('guest');
Route::get('/peluqueria',  [InicioController::class, 'peluqueriaWelcome'])->middleware('guest')->name('peluqueria.welcome');
Route::get('/admin',  [InicioController::class, 'adminWelcome'])->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'clienteDashboard'])->middleware(['auth:cliente', 'verified'])->name('dashboard');
Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->middleware(['auth:admin', 'verified'])->name('admin.dashboard');
Route::get('/peluqueria/dashboard', [DashboardController::class, 'peluqueriaDashboard'])->middleware(['auth:peluqueria', 'verified'])->name('peluqueria.dashboard');

Route::post('/admin/peluqueria/{peluqueria}/update_state/{peluqueriaEstado}', [PeluqueriaController::class, 'updateState'])->middleware(['auth:admin']);
Route::get('peluqueria/{peluqueria}/download_file', [PeluqueriaController::class, 'downloadFile'])->middleware(['auth:admin'])->name('peluqueria.file');

Route::get('/peluqueria/no_verificada', [PeluqueriaController::class, 'verificacionUpdate'])->middleware(['auth:peluqueria'])->name('peluqueria.noVerificada');
Route::post('/peluqueria/completar_informacion', [PeluqueriaController::class, 'completarInformacion'])->middleware(['auth:peluqueria'])->name('peluqueria.completarInfo');
Route::post('/peluqueria/update/documento', [PeluqueriaController::class, 'updateDocumento'])->middleware(['auth:peluqueria'])->name('peluqueria.updateDoc');
Route::get('/peluqueria/primeros_pasos', [PeluqueriaController::class, 'primerosPasos'])->middleware(['auth:peluqueria'])->name('peluqueria.primerosPasos');
Route::post('/peluqueria/nuevo_peluquero/', [PeluqueroController::class, 'store'])->middleware(['auth:peluqueria'])->name('peluquero.store');
Route::post('/peluqueria/actualizar_peluquero/{peluquero}', [PeluqueroController::class, 'update'])->middleware(['auth:peluqueria'])->name('peluquero.actualizar');
Route::delete('/peluqueria/eliminar_peluquero/{peluquero}', [PeluqueroController::class, 'destroy'])->middleware(['auth:peluqueria'])->name('peluquero.delete');
Route::post('/peluqueria/nuevo_servicio/', [ServicioController::class, 'store'])->middleware(['auth:peluqueria'])->name('servicio.store');
Route::post('/peluqueria/actualizar_servicio/{servicio}', [ServicioController::class, 'update'])->middleware(['auth:peluqueria'])->name('servicio.actualizar');
Route::delete('/peluqueria/eliminar_servicio/{servicio}', [ServicioController::class, 'destroy'])->middleware(['auth:peluqueria'])->name('servicio.delete');
Route::post('/peluqueria/agregar_dia', [DiaDeTrabajoController::class, 'store'])->middleware(['auth:peluqueria'])->name('diaDeTrabajo.store');
Route::post('/peluqueria/actualizar_dia/{diaDeTrabajo}', [DiaDeTrabajoController::class, 'update'])->middleware(['auth:peluqueria'])->name('diaDeTrabajo.update');
Route::delete('/peluqueria/eliminar_dia/{diaDeTrabajo}', [DiaDeTrabajoController::class, 'destroy'])->middleware(['auth:peluqueria'])->name('diaDeTrabajo.delete');


require __DIR__.'/auth.php';
require __DIR__.'/authAdmin.php';
require __DIR__.'/authPeluqueria.php';
