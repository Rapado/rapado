<?php

namespace App\Http\Controllers;

use App\Models\PeluqueriaEstado;
use App\Models\Cliente;
use App\Http\Resources\PeluqueriaEstadoCollection;
use App\Http\Resources\PeluqueroCollection;
use Illuminate\Support\Facades\Auth;
use DB;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function clienteDashboard()
    {   $cliente = Cliente::where('user_id', '=' ,Auth::user()->id)->first();
        $favoritos=DB::table('peluqueria_favoritas')
        ->join('peluquerias','peluquerias.id','=','peluqueria_favoritas.peluqueria_id')
        ->select('peluquerias.nombre','peluquerias.activa','peluquerias.direccion',
                'peluquerias.id','peluquerias.logo','peluquerias.telefono',)
        ->where('peluqueria_favoritas.cliente_id','=',$cliente->id)
        ->get();
        return Inertia::render('Cliente/Dashboard',['peluquerias' =>$favoritos,'horario' =>null]);
    }

    public function peluqueriaDashboard()
    {
        $peluqueria =  Auth::user()->peluqueria;

        if($peluqueria->estaVerificada()){
            if(!$peluqueria->primerosPasos()){ //significa que no tiene un horario, peluqueros o servicios guardados
                return Inertia::render('Peluqueria/Dashboard', ['peluqueros' => (new PeluqueroCollection($peluqueria->peluqueros))->opciones(false, true)]);
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
