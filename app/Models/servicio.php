<?php

namespace App\Models;

use App\Http\Resources\ServicioResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    public function peluqueros()
    {
        return $this->belongsToMany(Peluquero::class);
    }

    public function peluqueria()
    {
        return $this->belongsTo(Peluqueria::class);
    }

    public function citas()
    {
        return $this->belongsToMany(Cita::class);
    }

    public function getCostoAttribute($value)
    {
        return number_format($value, 2, '.', ',');
    }

    public function agregarPeluqueros($listaPeluqueros){
        $listaPeluqueros = substr($listaPeluqueros, 1, strlen($listaPeluqueros) - 2); //[2,1,3] => 2,1,3

        $peluqueros = explode(',', $listaPeluqueros); //el estring lo convierte a array
        $noPeluqueros = count($peluqueros);


         for($i = 0; $i < $noPeluqueros;  $i++){
            $this->agregarPeluquero($peluqueros[$i]);
         }
    }

    public function agregarPeluquero($peluqueroId){
        $peluqueroServicio = new PeluqueroServicio();

        $peluqueroServicio->peluquero_id = $peluqueroId;
        $peluqueroServicio->servicio_id = $this->id;
        $peluqueroServicio->save();
    }

    public function actualizarPeluqueros($listaPeluqueros){
        $listaPeluqueros = substr($listaPeluqueros, 1, strlen($listaPeluqueros) - 2); //[2,1,3] => 2,1,3

        $peluquerosFromFronted = explode(',', $listaPeluqueros); //el estring lo convierte a array
        $peluquerosOntable = $this->peluqueros->toArray();

        $i = 0;
        while($i < count($peluquerosOntable) && count($peluquerosOntable) > 0 && count($peluquerosFromFronted) > 0){
           $posicion = array_search(strval($peluquerosOntable[$i]['id']), $peluquerosFromFronted);
           if($posicion !== false){
               array_splice($peluquerosOntable, $i, 1);
               array_splice($peluquerosFromFronted, $posicion, 1);
           }else{
               $i++;
           }
        }

        for($i = 0; $i < count($peluquerosFromFronted); $i++){ // al final del while solo quedan lo nuevos peluqueros
             $this->agregarPeluquero($peluquerosFromFronted[$i]);
        }

        for($i = 0; $i < count($peluquerosOntable); $i++){ // al final del while solo quedan los peluqueros eliminados
             $this->peluqueros()->detach($peluquerosOntable[$i]['pivot']['peluquero_id']);
        }

        $this->load('peluqueros');
    }

    public function toResource()
    {
        return new ServicioResource($this);
    }
}
