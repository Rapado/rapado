<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use App\Rules\minutes;

class ServicioController extends Controller
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
        //validar campos y que la lista peluqueros tenga peluqueros
        $request ->validate([
            'servicioNombre' => 'required|min:4|max:90',
            'duracion'=> ['required','numeric', new minutes],
            'costo'=> 'required|numeric|min:0|max:5000',
            'imagen' => 'mimes:jpg,png,jpge',
            'listaPeluqueros' => 'string|min:3'//[1]
        ], $this->messages());

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
        $request ->validate([
            'servicioNombre' => 'required|min:4|max:90',
            'duracion'=> ['required','numeric', new minutes],
            'costo'=> 'required|numeric|min:0|max:9999',
            'imagen' =>[
            function ($attribute, $value, $fail) {
                if ($value != 'null') {
                    //if (mime_content_type($value) != 'png' && mime_content_type($value) != 'jpg'&& mime_content_type($value) != 'jpeg'){
                      //  $fail('The '.$attribute.' is invalid.'); 
                    //} 
                }
            },
        ],
            'listaPeluqueros' => 'string|min:3'//[1]
        ], $this->messages());

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
    public function messages()
    {
        return [
            'servicioNombre.required'=>'Favor de ingresar un nombre para su servicio',
            'duracion.numeric'=>'Favor de ingresar la duración de su servicio',
            'costo.numeric'=>'Favor de ingresar el costo a su servicio',
            'servicioNombre.max'=>'El nombre debe tener maximo 255 digitos',
            'servicioNombre.min'=>'El nombre debe tener almenos 4 digitos',
            'imagen.mimes'=>'La imagen debe ser formato jpg, png o jpge',
            'costo.min'=>'El costo no puede ser negativo',
            'costo.max'=>'El costo máximo debe ser 5000',
            'listaPeluqueros.min'=>'Seleccione al menos un peluquero'
        ];
    }
}
