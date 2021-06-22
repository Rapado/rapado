<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
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
        $request->validate([ 'nombre' => 'required|min:4|max:255'], $this->messages());
        $administrador = new Administrador();

        $administrador->id = $this->getRandomId();
        $administrador->nombre = $request['nombre'];
        $administrador->save();

        return response(['adminId' => $administrador->id]);
    }

    public function getRandomId()
    {
        $id = 0;
        do{
            $id = random_int(10500, 90950);
        }while(Administrador::find($id) !== null);

        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrador $administrador)
    {
        //
    }

    public function messages()
    {
        return [
            'peluqueroNombre.required'=>'Favor de ingresar el nombre del administrador',
            'peluqueroNombre.min'=>'El nombre del administrador es muy corto',
            'peluqueroNombre.max'=>'El nombre del administrador es muy largo',
        ];
    }
}
