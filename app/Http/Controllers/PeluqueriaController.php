<?php

namespace App\Http\Controllers;

use App\Models\Peluqueria;
use App\Models\PeluqueriaEstado;
use App\Http\Resources\PeluqueriaEstadoResource;
use App\Models\Peluquero;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            if($peluqueria->informacionCompleta()){
                $peluqueriaEstado = $peluqueria->peluqueriaEstado();
                return Inertia::render('Peluqueria/EsperandoVerificacion', ['peluqueriaEstado' => new PeluqueriaEstadoResource($peluqueriaEstado)]);
            }
            else
                return Inertia::render('Peluqueria/CompletarInformacion');
        }else{
            return redirect('/peluqueria/dashboard');
        }
    }

    public function completarInformacion(Request $request)
    {
        //validar informacion

        $peluqueria =  Auth::user()->peluqueria;

        $documentoPath = $request['documento']->store('documentos', 'public');
        $logoPath = $request['logo']->store('logos', 'public');

        $direccion = $peluqueria->concatenarDireccion($request);

        $peluqueria->nombreEncargado = $request['encargado'];
        $peluqueria->direccion = $direccion;
        $peluqueria->documento = $documentoPath;
        $peluqueria->logo = $logoPath;
        $peluqueria->save();

        $peluqueria->createEstado();

        return redirect('/peluqueria/no_verificada');
    }

    public function updateDocumento(Request $request)
    {
        $peluqueria =  Auth::user()->peluqueria;
        $documentoPath = $request['documento']->store('documentos', 'public');
        $oldDocPath = "/public/{$peluqueria->documento}";


        $peluqueria->documento = $documentoPath;
        $peluqueria->save();

        $peluqueria->updateEstado("enRevision"); //tenemos que pasar el estado a revision una vez reenvian el documento

        Storage::delete($oldDocPath);

        return back();
    }

    public function updateState(Request $request, Peluqueria $peluqueria, PeluqueriaEstado $peluqueriaEstado)
    {
        //validar
        if($peluqueria->id == $peluqueriaEstado->peluqueria_id){
            $peluqueriaEstado->estado = $request['estado'];
            $peluqueriaEstado->mensaje = $request['meessage'];
            $peluqueriaEstado->administrador_id = Auth::user()->administrador->id;

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

    public function downloadFile(Peluqueria $peluqueria){
        //validad que exista
       return response()->download($peluqueria->documentoPath());
    }

    public function primerosPasos()
    {
        $peluqueria = Auth::user()->peluqueria;
        if(!$peluqueria->tienePeluqueros()){
            $peluqeros = Peluquero::all();

            return Inertia::render('Peluqueria/AgregarPeluquero', ['firstTime' => true, 'peluqueros' => $peluqeros]);
        }
        elseif(!$peluqueria->tieneServicios())
            return Inertia::render('Peluqueria/AgregarServicio', ['firstTime' => true]);
        elseif($peluqueria->tieneHorario())
            return Inertia::render('Peluqueria/AgregarHorario', ['firstTime' => true]);
        else
            return redirect('/peluqueria/dashboard');

    }

    public function messages()
    {
        //aaa
    }

}
