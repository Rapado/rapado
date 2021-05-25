<?php

namespace App\Http\Controllers;

use App\Models\PeluqueriaEstado;
use App\Http\Resources\PeluqueriaEstadoCollection;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function clienteDashboard()
    {
        return Inertia::render('Cliente/Dashboard');
    }

    public function peluqueriaDashboard()
    {
        return Inertia::render('Peluqueria/Dashboard');
    }

    public function adminDashboard()
    {
        $peluqueriasNoAceptadas = PeluqueriaEstado::where('estado', '!=', 'aceptada')->get();

        return Inertia::render('Admin/Dashboard', [
            'peluqueriasPendientes' => Response (new PeluqueriaEstadoCollection($peluqueriasNoAceptadas))->original
        ]);
    }
}
