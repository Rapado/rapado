<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CitaCollection;
use App\Http\Resources\PeluqueriaEvaluacionCollection;

class PeluqueroResource extends JsonResource
{
    protected $retornaragenda = false;
    protected $retornarcitas = false;
    protected $retornarevaluaciones = false;
    protected $retornarestrellas = false;

    public function opciones($agenda = false, $citas = false,  $evaluaciones = false,  $estrellas = false, $servicios = false)
    {
        $this->retornaragenda = $agenda;
        $this->retornarcitas = $citas;
        $this->retornarevaluaciones = $evaluaciones;
        $this->retornarestrellas = $estrellas;
        $this->retornarServicios = $servicios;
        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'imagen' => $this->imagenPath(),
            'disponible' => $this->disponible,
            'estrellas' => $this->when($this->retornarestrellas,$this->estrellas()),
            'evaluaciones' => $this->when($this->retornarevaluaciones,$this->evaluaciones),
            'agenda' => $this->when($this->retornaragenda, $this->agenda()),
            'citas' => $this->when($this->retornarcitas, new CitaCollection($this->citas)),
            'servicios' => $this->when($this->retornarServicios, new ServicioCollection($this->servicios)),
            'noEvaluaciones' => $this->numeroEvaluaciones(),
            //'evaluacionesss'=>$this->when($this->retornarevaluacion, new PeluqueriaEvaluacionCollection($this->evaluaciones)),

        ];
    }
}
