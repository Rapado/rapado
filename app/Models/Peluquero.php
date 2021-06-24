<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PeluqueroEvaluacion;
use App\Http\Resources\PeluqueroResource;
use App\Traits\TimeHelper;
use DB;

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
        $cita = $this->citas()->where('hora_inicio','<=', $hora)->Where('horaTermina', '>', $hora)->first();

        if(isset($cita)){
            $duracionCita = 0;

            if($cita->hora_inicio == $hora)
                $duracionCita = $cita->duracion();
            else
                $duracionCita = $this->minutosEntreHoras($cita->hora_inicio, $hora);

            return ['ocupado' => true, 'duracion' => $duracionCita, 'citaId' => $cita->id, 'minutosDisponibles' => 0];
        }else{
            return ['duracion' => 0, 'ocupado' => false, 'citaId' => null, 'minutosDisponibles' => 0];
        }

    }

    public function ocupadoA($hora)
    {
        $cita = $this->citas()->where('hora_inicio','<=', $hora)->Where('horaTermina', '>', $hora)->first();
        return isset($cita);
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

        $evaluaciones = $this->evaluaciones;
        $estrella = 0;
        if(count($evaluaciones)>0){
            foreach($evaluaciones as $evaluacion){
                $estrella += $evaluacion->estrellas;
            }
            $promedio = $estrella/count($evaluaciones);
            $estrella = round( $promedio);
        }
        return $estrella;
    }

    public function numeroEvaluaciones()
    {
        return count($this->evaluaciones);
    }

    public function agenda()
    {
        $agenda = [];
        $espacioActual = ['duracion' => 0];
        $contadorDeEspacios = 0;

        $peluqueriaHorario = $this->peluqueria->horarioDeHoy();

        // dd($this->peluqueria->sigueAbierta());
        if($peluqueriaHorario != null && $this->peluqueria->sigueAbierta()){

            $numeroEspacios = $this->espaciosEntreDosHoras($peluqueriaHorario['horaActual'], $peluqueriaHorario['cierre'], 15);
            $horaDeLaJornada = $peluqueriaHorario['horaActual'];

            for($i = 0; $i < $numeroEspacios; $i++){

                if($espacioActual['duracion'] <= 0) //no se busca por una cita hasta que se termine el timepo de la que se encontro5
                    $espacioActual = $this->citaA($horaDeLaJornada); // si el peluquero tiene una cita a esa hora, retorna array con duracion y otros campos

                $espacioActual['duracion'] > 0 ? $espacioActual['duracion'] -= 15 : null;

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
