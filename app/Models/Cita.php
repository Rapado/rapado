<?php

namespace App\Models;

use App\Traits\TimeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    use TimeHelper;

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function peluquero()
    {
        return $this->belongsTo(Peluquero::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class);
    }

    public function duracion()
    {
        return $this->minutosEntreHoras($this->hora_inicio, $this->horaTermina);
    }
}
