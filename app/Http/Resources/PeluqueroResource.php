<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CitaCollection;
use App\Http\Resources\ServicioCollection;

class PeluqueroResource extends JsonResource
{
    protected $retornarAgenda = false;
    protected $retornarCitas = false;
    protected $retornarServicios = false;

    public function opciones($agenda = false, $citas = false, $servicios = false)
    {
        $this->retornarAgenda = $agenda;
        $this->retornarCitas = $citas;
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
            'estrellas' => $this->estrellas(),
            'agenda' => $this->when($this->retornarAgenda, $this->agenda()),
            'citas' => $this->when($this->retornarCitas, new CitaCollection($this->citas)),
            'servicios' => $this->when($this->retornarServicios, new ServicioCollection($this->servicios)),
        ];
    }
}
