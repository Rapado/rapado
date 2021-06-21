<?php

namespace App\Traits;

use DateTime;

trait TimeHelper {

    public function getNumberDay($day)
    {
        switch ($day) {
            case 'Monday':
                return 1;
            case 'Tuesday':
                return 2;
            case 'Wednesday':
                return 3;
            case 'Thursday':
                return 4;
            case 'Friday':
                return 4;
            case 'Saturday':
                return 6;
            case 'Sunday':
                return 7;
        }
    }

    public function minutosEntreHoras($inicio, $fin)
    {
        $inicio = new DateTime($inicio);
        $fin = new DateTime($fin);
        $intervalo = $inicio->diff($fin);

        return (($intervalo->h * 60) + $intervalo->i);
    }

    public function espaciosEntreDosHoras($incio, $fin, $duracionMin)
    {
        return $this->minutosEntreHoras($incio, $fin) / $duracionMin;
    }

    public function actualizarHora($hora, $minutos)
    {
        $date = date($hora);
        $time = strtotime($date);
        $time = $time + ($minutos * 60);
        return date("H:i:s", $time);
    }

    public function obtenerHoraActualRedondeada()
    {
        $date = date('H:i');
        $minutos = intval(explode(':', $date)[1]);
        $time = strtotime($date);

        if($minutos > 0 && $minutos < 15 )
            $time += (15 - $minutos) * 60;
        else if($minutos > 15 && $minutos < 30 )
            $time += (30 - $minutos) * 60;
        else if($minutos > 30 && $minutos < 45 )
            $time += (45 - $minutos) * 60;
        else if($minutos > 45 && $minutos <= 59 ) //aqui hay un bug
            $time += (60 - $minutos) * 60;

        return date("H:i:s", $time);
    }

    public function horaActual()
    {
        return date('H:i:s');
    }

    public function getTodayNumber()
    {
      return $this->getNumberDay(date('l'));
    }
}

