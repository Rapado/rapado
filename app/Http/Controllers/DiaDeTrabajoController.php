<?php

namespace App\Http\Controllers;

use App\Models\DiaDeTrabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaDeTrabajoController extends Controller
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
        //validar campos y que cierre sea mayor a apertura
        $request ->validate([
            'apertura' => 'required_unless:cierre,null, lt:cierre',
            'cierre' => 'required_unless:cierre,null'
        ], $this->messages());

        $peluqueriaId = Auth::user()->peluqueria->id;
        $diaDeTrabajo = new DiaDeTrabajo();

        $diaDeTrabajo->peluqueria_id = $peluqueriaId;
        $diaDeTrabajo->dia = $request['numeroDia'];
        $diaDeTrabajo->apertura = $request['apertura'];
        $diaDeTrabajo->cierre = $request['cierre'];
        $diaDeTrabajo->save();

        return response(['diaDeTrabajo' => $diaDeTrabajo->toResource()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiaDeTrabajo  $diaDeTrabajo
     * @return \Illuminate\Http\Response
     */
    public function show(DiaDeTrabajo $diaDeTrabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiaDeTrabajo  $diaDeTrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(DiaDeTrabajo $diaDeTrabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiaDeTrabajo  $diaDeTrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiaDeTrabajo $diaDeTrabajo)
    {
        //validar la informacion

        $diaDeTrabajo->apertura = $request['apertura'];
        $diaDeTrabajo->cierre = $request['cierre'];
        $diaDeTrabajo->save();

        return response(['diaDeTrabajo' => $diaDeTrabajo->toResource()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiaDeTrabajo  $diaDeTrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiaDeTrabajo $diaDeTrabajo)
    {
        $diaDeTrabajo->delete();

        return response(['data' => 'deleted']);
    }
    public function messages()
    {
        return [
        ];
    }
}
