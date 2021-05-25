<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeluqueriaEstado extends Model
{
    use HasFactory;

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

    public function peluqueria()
    {
        return $this->belongsTo(Peluqueria::class);
    }

    public function getPeluqueriaInfo()
    {
        return $this->peluqueria->getArray();
    }

    public function getEstadoInfo()
    {
        switch ($this->estado) {
            case 'aceptada':
                return ['string' => 'Aceptada', 'estado' => 'aceptada', 'class' => 'bg-green-100'];
            case 'enRevision':
                return ['string' => 'En revisión', 'estado' => 'enRevision', 'class' => 'bg-green-100'];
            case 'rechazada':
                return ['string' => 'Rechazada', 'estado' => 'rechazada', 'class' => 'bg-red-200'];
            case 'reenviarDoc':
                return ['string' => 'Reenviar documento', 'estado' => 'reenviarDoc', 'class' => 'bg-yellow-100'];
            default:
               return 'Desconocido';
        }
    }

}
