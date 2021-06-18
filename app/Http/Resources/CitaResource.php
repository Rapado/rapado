<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ServicioCollection;

class CitaResource extends JsonResource
{
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
            'horaInicio' => $this->hora_inicio,
            'horaTermina' => $this->horaTermina,
            'duracion' => $this->duracion(),
            'servicios' => new ServicioCollection($this->servicios), //hacer opcion para que no retorne los peluqueros
            'nombreCliente' => $this->nombre,
            'peluquero' => $this->peluquero->nombre,
        ];
    }
}
