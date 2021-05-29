<?php

namespace App\Http\Controllers;

use App\Models\PeluqueriaEstado;
use App\Http\Resources\PeluqueriaEstadoCollection;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function clienteDashboard()
    {
        return Inertia::render('Cliente/Dashboard');
    }

    public function peluqueriaDashboard()
    {
        $peluqueria =  Auth::user()->peluqueria;

        if($peluqueria->estaVerificada()){
            return Inertia::render('Peluqueria/Dashboard');
        }else{
            return redirect('/peluqueria/no_verificada');
        }
    }

    public function adminDashboard()
    {
        $peluqueriasNoAceptadas = PeluqueriaEstado::where('estado', '!=', 'aceptada')->get();

        return Inertia::render('Admin/Dashboard', [
            'peluqueriasPendientes' => Response (new PeluqueriaEstadoCollection($peluqueriasNoAceptadas))->original
        ]);
    }
}
