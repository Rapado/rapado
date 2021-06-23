<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class InicioController extends Controller
{
    public function clienteWelcome()
    {
        return Inertia::render('Cliente/Welcome', [
            'canResetPassword' => Route::has('password.request'),
        ]);
    }
    public function peluqueriaWelcome()
    {
        return Inertia::render('Peluqueria/Welcome',[
            'canResetPassword' => Route::has('password.request'),
        ]);
    }

    public function adminWelcome()
    {
        return Inertia::render('Admin/Welcome',[
            'canResetPassword' => Route::has('password.request'),
        ]);
    }

    public function primeraVez()
    {
        return Inertia::render('Cliente/PrimeraVez');
    }
}
