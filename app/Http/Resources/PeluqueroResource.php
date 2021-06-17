<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeluqueroResource extends JsonResource
{
    protected $retornarAgenda = false;

    public function conAgenda($agenda = false)
    {
        $this->retornarAgenda = $agenda;
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
            'agenda' => $this->retornarAgenda ? $this->agenda() : null,
        ];
    }
}
