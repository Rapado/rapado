<?php

namespace App\Http\Controllers;

use App\Models\Peluqueria;
use App\Models\PeluqueriaEstado;
use App\Http\Resources\PeluqueriaEstadoResource;
use Inertia\Inertia;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PeluqueriaController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peluqueria  $peluqueria
     * @return \Illuminate\Http\Response
     */
    public function show(Peluqueria $peluqueria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peluqueria  $peluqueria
     * @return \Illuminate\Http\Response
     */
    public function edit(Peluqueria $peluqueria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peluqueria  $peluqueria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peluqueria $peluqueria)
    {
        //
    }

    public function verificacionUpdate()
    {
        $peluqueria =  Auth::user()->peluqueria;

        if(!$peluqueria->estaVerificada()){
            if($peluqueria->informacionCompleta())
                return Inertia::render('Peluqueria/EsperandoVerificacion');
            else
                return Inertia::render('Peluqueria/CompletarInformacion');
        }else{
            return redirect('/peluqueria/dashboard');
        }
    }

    public function completarInformacion(Request $request)
    {
        //validate info yo voy a validar
        $peluqueria =  Auth::user()->peluqueria;

        $documentoPath = "testingg";
        $direccion = $peluqueria->concatenarDireccion($request);

        $peluqueria->nombreEncargado = $request['encargado'];
        $peluqueria->direccion = $direccion;
        $peluqueria->documento = $documentoPath;
        $peluqueria->save();

        return redirect('/peluqueria/no_verificada');


    }

    public function updateState(Request $request, Peluqueria $peluqueria, PeluqueriaEstado $peluqueriaEstado)
    {
        if($peluqueria->id == $peluqueriaEstado->peluqueria_id){
            $peluqueriaEstado->estado = $request['estado'];
            $peluqueriaEstado->save();

            if($peluqueriaEstado->estado != 'aceptada'){
                return response(new PeluqueriaEstadoResource($peluqueriaEstado));
            }else{
                $peluqueria->activa = true;
                $peluqueria->save();
                return response('clearBarber');
            }
        }

        return response('Hubo un error', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peluqueria  $peluqueria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peluqueria $peluqueria)
    {
        //
    }
}
