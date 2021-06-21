<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeluqueroCollection;
use App\Http\Resources\ServicioCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ServicioController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peluqueria = Auth::user()->peluqueria;

        return Inertia::render('Peluqueria/AgregarServicio', [
                                    'peluqueros' => new PeluqueroCollection($peluqueria->peluqueros),
                                    'servicios' => new ServicioCollection($peluqueria->servicios),
                                ]);
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
        //validar campos y que la lista peluqueros tenga peluqueros
        $peluqueriaId = Auth::user()->peluqueria->id;

        $imagenPath = $request['imagen']->store('servicios', 'public');

        $servicio = new Servicio();
        $servicio->peluqueria_id = $peluqueriaId;
        $servicio->nombre = $request['servicioNombre'];
        $servicio->duracion = $request['duracion'];
        $servicio->costo = $request['costo'];
        $servicio->imagen = $imagenPath;
        $servicio->save();

        $servicio->agregarPeluqueros($request['listaPeluqueros']);

        return response(['servicio' => $servicio->toResource()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        //validar campos y que la lista tenga peluqueros

        $peluqueriaId = Auth::user()->peluqueria->id;

        if($peluqueriaId == $servicio->peluqueria_id){
            $servicio->nombre = $request['servicioNombre'];
            $servicio->duracion = $request['duracion'];
            $servicio->costo = $request['costo'];

            if(gettype($request['imagen']) != "string"){
                $oldPath = "/public/{$servicio->imagen}";
                $newPath = $request['imagen']->store('servicios', 'public');

                $servicio->imagen = $newPath;
                $servicio->save();

                Storage::delete($oldPath);
            }
            else{
                $servicio->save();
            }

            $servicio->actualizarPeluqueros($request['listaPeluqueros']);
            return response(['servicio' => $servicio->toResource(), 'peluqueros' => $servicio->peluqueros]);
        }

       return back(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        $peluqueriaId = Auth::user()->peluqueria->id;

        if($peluqueriaId == $servicio->peluqueria_id){
            $oldPath = "/public/{$servicio->imagen}";
            $servicio->delete();

            Storage::delete($oldPath);
            return response(['data' => 'done']);
        }

       return back(404);
    }
}
