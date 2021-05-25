<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PeluqueriaController;

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


require __DIR__.'/auth.php';
require __DIR__.'/authAdmin.php';
require __DIR__.'/authPeluqueria.php';
