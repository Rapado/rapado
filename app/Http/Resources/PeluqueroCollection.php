<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PeluqueroCollection extends ResourceCollection
{
    protected $retornaragenda;
    protected $retornarcitas;
    protected $retornarevaluaciones;
    protected $retornarestrellas;

    public function opciones($agenda = false, $citas = false,  $evaluaciones = false,  $estrellas = false)
    {
        $this->retornaragenda = $agenda;
        $this->retornarcitas = $citas;
        $this->retornarevaluaciones = $evaluaciones;
        $this->retornarestrellas = $estrellas;
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
        $this->collection->each->opciones($this->retornaragenda, $this->retornarcitas, $this->retornarevaluaciones, $this->retornarestrellas);
        return $this->collection;
    }
}
