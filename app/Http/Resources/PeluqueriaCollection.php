<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PeluqueriaCollection extends ResourceCollection
{
    protected $mostrarservicios = true;
    protected $mostrarpeluqueros = true;
    protected $mostrarevaluacion = true;
    protected $mostrarfavorita = true;
    protected $mostrarestrellas = true;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->each->opciones($this->mostrarservicios, $this->mostrarpeluqueros, $this->mostrarevaluacion, $this->mostrarfavorita, $this->mostrarestrellas);
        return $this->collection;
    }
    public function opciones($servicios = true,$peluqueros = true, $evaluacion= true, $favorita= true, $estrellas=true)
    {
        $this->mostrarservicios = $servicios;
        $this->mostrarpeluqueros = $peluqueros;
        $this->mostrarevaluacion = $evaluacion;
        $this->mostrarfavorita = $favorita;
        $this->mostrarestrellas = $estrellas;
        return $this;
    }
}
