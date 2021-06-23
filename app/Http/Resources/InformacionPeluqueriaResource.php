<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InformacionPeluqueriaResource extends JsonResource
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
            'mensaje' => $this->mensaje,
            'peluqueria' => $this->getPeluqueriaInfo(),
            'admin' => isset($this->administrador) ? $this->administrador->nombre : 'No ha sido revisado',
            'ultimaRevision' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
