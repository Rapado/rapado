<?php

namespace App\Http\Controllers;

use App\Models\PeluqueriaEstado;
use App\Http\Resources\PeluqueriaEstadoCollection;
use App\Http\Resources\PeluqueroCollection;
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
            if(!$peluqueria->primerosPasos()){ //significa que no tiene un horario, peluqueros o servicios guardados
                return Inertia::render('Peluqueria/Dashboard', ['peluqueros' => (new PeluqueroCollection($peluqueria->peluqueros))->conAgenda(true)]);
            }else{
                return redirect('/peluqueria/primeros_pasos');
            }
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
