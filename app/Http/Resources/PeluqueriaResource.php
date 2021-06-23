<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PeluqueroCollection;
use App\Http\Resources\ServicioCollection;
use App\Http\Resources\PeluqueriaEvaluacionCollection;
use App\Http\Resources\PeluqueriaFavoritaCollection;

class PeluqueriaResource extends JsonResource
{  
    protected $mostrarservicios = true;
    protected $mostrarpeluqueros = true;
    protected $mostrarevaluacion = true;
    protected $mostrarfavorita = true;
    protected $mostrarestrellas = true;
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'telefono'=>$this->telefono,
            'encargado'=>$this->nombreEncargado,
            'logo'=>$this->logo,
            'activa'=>$this->activa,
            'direccion'=>$this->direccion,
            'horario'=>$this->horarioDeHoy(),//funcion
            'estrellas' => $this->estrellas(),
            'servicios'=>$this->when($this->mostrarservicios, new ServicioCollection($this->servicios)),
            'peluqueros'=>$this->when($this->mostrarpeluqueros, (new PeluqueroCollection($this->peluqueros))->opciones(true, true, true, true)),
            'evaluaciones'=>$this->when($this->mostrarevaluacion, new PeluqueriaEvaluacionCollection($this->evaluaciones)),
                            
            //'favorita'=>$this->when($this->Mostrarfavorita, new PeluqueriaFavoritaCollection($this->favoritas)),
            
            //'evaluacion'=>$this->when($this->Mostrarevaluacion,$this->evaluaciones),
            ];
    }
    public function opciones($servicios = true,$peluqueros = true,$evaluacion = true, $favorita= true, $estrellas = true)
    {
        $this->mostrarservicios = $servicios;
        $this->mostrarpeluqueros = $peluqueros;
        $this->mostrarevaluacion = $evaluacion;
        $this->mostrarfavorita = $favorita;
        $this->mostrarestrellas = $estrellas;
        return $this;
    }
}
