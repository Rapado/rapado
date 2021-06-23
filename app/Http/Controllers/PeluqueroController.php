<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeluqueroCollection;
use App\Models\Peluquero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class PeluqueroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Peluqueria/AgregarPeluquero', ['peluqueros' => new PeluqueroCollection(Auth::user()->peluqueria->peluqueros)]);
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

    public function cambiarPeluqueroEstado(Request $request, Peluquero $peluquero)
    {
        $peluqueriaId = Auth::user()->peluqueria->id;

        if($peluquero->peluqueria_id == $peluqueriaId){ // verifica que el peluquero pertenezca a la peluqueria autenticada
            $peluquero->disponible = !$peluquero->disponible;
            $peluquero->save();

            return response('updated');
        }
        return response('error', 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar
        $request ->validate([//-----------------------------------Hecho Luis
            'peluqueroNombre' => 'required|min:4|max:255',
            'imagen' => 'mimes:jpg,png,jpge',
        ], $this->messages());
        $peluquero = new Peluquero();
        $imagenPath = $request['imagen']->store('peluqueros', 'public');

        $peluquero->peluqueria_id = Auth::user()->peluqueria->id;
        $peluquero->nombre = $request['peluqueroNombre'];
        $peluquero->imagen = $imagenPath;
        $peluquero->save();

        return response(['peluquero' => $peluquero->toResource()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peluquero  $peluquero
     * @return \Illuminate\Http\Response
     */
    public function show(Peluquero $peluquero)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peluquero  $peluquero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peluquero $peluquero)
    {
        //validar
        $request ->validate([ 'peluqueroNombre' => 'required|min:4|max:255'], $this->messages());
      
        $peluqueriaId = Auth::user()->peluqueria->id;

        if($peluqueriaId == $peluquero->peluqueria_id){
            $peluquero->nombre = $request['peluqueroNombre'];

            if(gettype($request['imagen']) != "string"){
                $oldPath = "/public/{$peluquero->imagenPath()}";

                $request ->validate(['imagen' => 'nullable|mimes:jpg,png,jpge'], $this->messages());

                $newPath = $request['imagen']->store('peluqueros', 'public');

                $peluquero->imagen = $newPath;
                $peluquero->save();

                Storage::delete($oldPath);
            }
            else{
                $peluquero->save();
            }


            return response(['peluquero' => $peluquero->toResource()]);
        }

       return back(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peluquero  $peluquero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peluquero $peluquero)
    {
        if(count($peluquero->citas) > 0)
            return response(['status' => 'tieneCitas'], 400);

        $peluqueriaId = Auth::user()->peluqueria->id;

        if($peluqueriaId == $peluquero->peluqueria_id){
            $oldPath = "/public/{$peluquero->imagen}";
            $peluquero->delete();

            Storage::delete($oldPath);
            return response(['data' => 'done']);
        }

       return back(404);
    }
    public function messages()//-------------------------Hecho Luis
    {
        return [
            'peluqueroNombre.required'=>'Favor de ingresar el nombre del peluquero',
            'peluqueroNombre.min'=>'El nombre del encargado es muy corto',
            'peluqueroNombre.max'=>'El nombre del encargado es muy largo',
            'imagen.mimes'=>'La imagen debe ser formato jpg, png o jpge',
        ];
    }
}
