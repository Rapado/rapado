<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeluqueriaFavoritaResource extends JsonResource
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
            'cliente_nombre'=>$this->cliente->user_id,
            'peluqueria_id' => $this->peluqueria_id,
        ];
    }
}
