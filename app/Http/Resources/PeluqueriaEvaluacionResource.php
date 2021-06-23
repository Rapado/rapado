<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeluqueriaEvaluacionResource extends JsonResource
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
            'id'=>$this->id,
            'estrellas'=>$this->estrellas,
            'comentario'=>$this->comentario,
            'fecha'=>$this->created_at->format('D/M/Y'),
            'cliente_nombre'=>$this->cliente->nombre,
        ];
    }
}
