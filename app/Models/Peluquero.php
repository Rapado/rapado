<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\PeluqueroResource;
use App\Traits\TimeHelper;

class Peluquero extends Model
{
    use HasFactory;
    use TimeHelper;

    public function peluqueria()
    {
        return $this->belongsTo(Peluqueria::class);
    }

    public function evaluaciones()
    {
        return $this->hasMany(PeluqueroEvaluacion::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function citaA($hora)
    {
        $cita = $this->citas()->where('hora_inicio', $hora)->first();

        if(isset($cita)){
            return ['ocupado' => true, 'duracion' => $cita->duracion(), 'citaId' => $cita->id, 'minutosDisponibles' => 0];
        }else{
            return ['duracion' => 0, 'ocupado' => false, 'citaId' => null, 'minutosDisponibles' => 0];
        }

    }

    public function imagenPath()
    {
        // return "/storage/".$this->imagen;
        return $this->imagen;
    }

    public function toResource()
    {
        return new PeluqueroResource($this);
    }

    public function estrellas()
    {
        return 3;
    }

    public function agenda()
    {
        $agenda = [];
        $espacioActual = ['duracion' => 0];
        $contadorDeEspacios = 0;

        $peluqueriaHorario = $this->peluqueria->horarioDeHoy();
        if($peluqueriaHorario != null){

            $numeroEspacios = $this->espaciosEntreDosHoras($peluqueriaHorario['horaActual'], $peluqueriaHorario['cierre'], 15);
            $horaDeLaJornada = $peluqueriaHorario['horaActual'];

            for($i = 0; $i < $numeroEspacios; $i++){

                if($espacioActual['duracion'] <= 0) //no se busca por una cita hasta que se termine el timepo de la que se encontro
                $espacioActual = $this->citaA($horaDeLaJornada); // si el peluquero tiene una cita a esa hora, retorna array con duracion y otros campos

                $espacioActual > 0 ? $espacioActual['duracion'] -= 15 : null;

                array_push($agenda, ['hora' => $horaDeLaJornada, 'ocupado' => $espacioActual['ocupado'],
                'citaId' => $espacioActual['citaId'], 'minutosDisponibles' => 0]);

                $horaDeLaJornada = $this->actualizarHora($horaDeLaJornada, 15);
            }

            for($i = $numeroEspacios - 1; $i >= 0; $i--){ //vemos cuantos minutos hay disponibles despues de cada espacio
                $contadorDeEspacios++;

                if($agenda[$i]['ocupado'])
                $contadorDeEspacios = 0;

                $agenda[$i]['minutosDisponibles'] = $contadorDeEspacios * 15;
            }
        }

        return $agenda;
    }
}
