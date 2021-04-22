<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/admin', function () {
    return Inertia::render('Admin/Welcome',
    [
        // 'canLogin' => Route::has('login'),
        'canResetPassword' => Route::has('password.request'),
    ]
    );
});

Route::get('/peluqueria', function () {
    return Inertia::render('Peluqueria/Welcome',[
        // 'canLogin' => Route::has('login'),
        'canResetPassword' => Route::has('password.request'),
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/peluqueria/dashboard', function () {
    return Inertia::render('Peluqueria/Dashboard');
})->middleware(['auth', 'verified'])->name('peluqueria.dashboard');


require __DIR__.'/auth.php';
require __DIR__.'/authAdmin.php';
require __DIR__.'/authPeluqueria.php';
