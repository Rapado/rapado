<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeluqueroCollection;
use App\Jobs\EliminarCita;
use App\Models\Cita;
use App\Models\Peluqueria;
use App\Models\Peluquero;
use App\Traits\TimeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CitaController extends Controller
{
    use TimeHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Peluqueria $peluqueria)
    {
        if($peluqueria->sigueAbierta())
            return Inertia::render('Cliente/Agendar', ['peluqueriaId' => $peluqueria->id, 'peluqueros' => (new PeluqueroCollection($peluqueria->peluqueros))->opciones(true, false, true, false, true)]);
        else
            return redirect('/dashboard');
    }

    public function agendarDesdePeluqueria()
    {
        $peluqueria = Auth::user()->peluqueria;
        return Inertia::render('Peluqueria/Agendar', ['peluqueriaId' => $peluqueria->id, 'peluqueros' => (new PeluqueroCollection($peluqueria->peluqueros))->opciones(true, false, true, false, true)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Peluqueria $peluqueria)
    {
        $user = Auth::user();
        $peluquero = Peluquero::findOrFail($request['peluqueroId']);

        if(isset($user->cliente)) //un cliente no puede agendar mas de dos citas
            if(count($user->citas) > 1)
                return response(['status' => 'noCitasExcedido'], 400);

        if(!$peluquero->disponible)
            return response(['status' => 'peluqeroNoDisponible'], 400);

        if($request['horaCita'] < $this->horaActual() || $peluquero->ocupadoA($request['horaCita'])){
            return response(['status' => 'horaNoDisponible', 'peluqueros' => (new PeluqueroCollection($peluqueria->peluqueros))->opciones(true, false, false)], 400);
        }

        $horaTermina = $this->actualizarHora($request['horaCita'], $request['duracionCita']);

        $cita = new Cita();
        $cita->user_id = $user->id;
        $cita->peluquero_id = $request['peluqueroId'];
        $cita->nombre = $request['nombreCliente'];
        $cita->hora_inicio = $request['horaCita'];
        $cita->horaTermina = $horaTermina;
        $cita->save();

        $cita->guardarServicios($request['servicios']);

        EliminarCita::dispatch($cita)->delay(now()->addMinutes($this->minutosEntreHoras($this->horaActual(), $horaTermina) + 5));

        return response('todoBien');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return response('success');
    }
}
