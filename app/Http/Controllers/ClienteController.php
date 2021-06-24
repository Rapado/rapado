<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use App\Models\Peluqueria;
use App\Models\Peluquero;
use APP\Models\Servicio;
use App\Models\PeluqueriaFavorita;
use App\Models\PeluqueriaEvaluacion;
use App\Models\PeluqueroEvaluacion;
use App\Http\Resources\PeluqueriaCollection;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PeluqueroCollection;
use DB;
use Carbon\Carbon;
use App\Http\Resources\PeluqueriaEvaluacionCollection;

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

        return response(['data'=>'recibi peluqueria'.$peluqueria->nombre, 'peluqueriaFavorita' => $peluqueria_favorita]);
    }

    public function quitarDeFavoritos(PeluqueriaFavorita $peluqueriaFavorita)
    {
        $peluqueriaFavorita->delete();

        return response('done');
    }
    public function Evaluar(Request $request, Peluqueria $peluqueria)
    {
        $request->validate([
            'estrellas' => 'min:1|max:5'
        ]);

        $cliente =  Auth::user()->cliente;
        $evaluaciones = $cliente->evaluacionesDePeluquerias()->where('peluqueria_id',$peluqueria->id)->first();
        $peluqueria_evaluacion = null;

        if(isset($evaluaciones)){
            $peluqueria_evaluacion = $evaluaciones;
        }
        else{
            $peluqueria_evaluacion = new PeluqueriaEvaluacion();
            $peluqueria_evaluacion->cliente_id = $cliente->id;
            $peluqueria_evaluacion->peluqueria_id = $peluqueria->id;
        }

        $peluqueria_evaluacion->estrellas = $request['estrellas'];
        $peluqueria_evaluacion->comentario = $request['comentario'];
        $peluqueria_evaluacion->save();
        return response(['data'=>new PeluqueriaEvaluacionCollection($peluqueria->evaluaciones)]);
    }
    public function EvaluarPeluquero(Request $request, Peluqueria $peluqueria, Peluquero $peluquero)
    {
        $request->validate([
            'estrellas' => 'min:1|max:5'
        ]);

        $cliente =  Auth::user()->cliente;
        $evaluaciones = $cliente->evaluacionesAPeluqueros()->where('peluquero_id',$peluquero->id)->first();
        $peluquero_evaluacion = null;
        if(isset($evaluaciones)){
            $peluquero_evaluacion = $evaluaciones;
        }
        else{
            $peluquero_evaluacion = new PeluqueroEvaluacion();
            $peluquero_evaluacion->cliente_id = $cliente->id;
            $peluquero_evaluacion->peluquero_id = $peluquero->id;
        }

        $peluquero_evaluacion->estrellas = $request['estrellas'];
        $peluquero_evaluacion->save();

        return response(['estrellas'=> $peluquero->estrellas()]);
    }

    public function peluqueria(Peluqueria $peluqueria)
    {

        $cliente = Cliente::where('user_id', '=' ,Auth::user()->id)->first();
        $favoritos = PeluqueriaFavorita::where([['cliente_id' ,'=', $cliente->id],['peluqueria_id' ,'=',$peluqueria->id ]])->first();

        return Inertia::render('Cliente/Peluqueria', ['peluquerias' => $peluqueria->toResource(true,true,true,true), 'favorito' => $favoritos]);

    }
    public function peluquerias_favoritas()
    {   $cliente = Cliente::where('user_id', '=' ,Auth::user()->id)->first();
        $favoritos=DB::table('peluqueria_favoritas')
        ->join('peluquerias','peluquerias.id','=','peluqueria_favoritas.peluqueria_id')
        ->select('peluquerias.nombre','peluquerias.activa','peluquerias.direccion',
                'peluquerias.id','peluquerias.logo','peluquerias.telefono',)
        ->where('peluqueria_favoritas.cliente_id','=',$cliente->id)
        ->get();

        return Inertia::render('Cliente/Peluquerias',['peluquerias.data' =>$favoritos,'horario' =>null]);
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
