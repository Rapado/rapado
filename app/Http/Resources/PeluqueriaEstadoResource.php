<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeluqueriaEstadoResource extends JsonResource
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
            'idEstado' => $this->id,
            'estadoInfo' => $this->getEstadoInfo(),
            'peluqueria' => $this->getPeluqueriaInfo(),
            'admin' => $this->administrador->nombre,
            'ultimaRevision' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
