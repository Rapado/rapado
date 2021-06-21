<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PeluqueroCollection extends ResourceCollection
{
    protected $retornarAgenda;
    protected $retornarCitas;
    protected $retornarServicios;


    public function opciones($agenda = false, $citas = false, $servicios = false)
    {
        $this->retornarAgenda = $agenda;
        $this->retornarCitas = $citas;
        $this->retornarServicios = $servicios;
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
        $this->collection->each->opciones($this->retornarAgenda, $this->retornarCitas, $this->retornarServicios);
        return $this->collection;
    }
}
