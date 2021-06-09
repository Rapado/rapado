<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicioResource extends JsonResource
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
            'nombre' => $this->nombre,
            'duracion' => $this->duracion,
            'costo' => $this->costo,
            'imagen' => $this->imagen,
            'peluqueros' => new PeluqueroCollection($this->peluqueros),
        ];
    }
}
