<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PeluqueroCollection extends ResourceCollection
{
    protected $retornarAgenda;

    public function conAgenda($agenda = false)
    {
        $this->retornarAgenda = $agenda;
        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function toArray($request)
    // {
    //     return $this->collection;
    // }

    public function toArray($request){
        // or use HigherOrderCollectionProxy
        // return $this->collection->each->foo($this->foo)->map->toArray($request)->all()

        // or simple
        $this->collection->each->conAgenda($this->retornarAgenda);
        return $this->collection;
    }
}
