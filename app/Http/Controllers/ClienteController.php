<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Peluqueria;
use App\Models\Peluquero;
use APP\Models\Servicio;
use App\Models\PeluqueriaFavorita;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function favoritos(Peluqueria $peluqueria)
    {
        $peluqueria_favorita = new PeluqueriaFavorita();
        $peluqueria_favorita->cliente_id = Auth::user()->cliente->id;
        $peluqueria_favorita->peluqueria_id = $peluqueria->id;
        $peluqueria_favorita->save();
        return response(['data'=>'recibi peluqueria'.$peluqueria->nombre]);
    }
    public function peluqueria(Peluqueria $peluqueria)
    {
        //$peluquerias = Peluqueria::find($peluqueria->id);
        $peluqueros = $peluqueria->peluqueros;
        $servicios = $peluqueria->servicios;
        return Inertia::render('Cliente/Peluqueria', ['peluquerias' => $peluqueria,'peluqueros' => $peluqueros,'servicios' => $servicios]);  
    }
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
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
