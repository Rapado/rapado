<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\PeluqueroResource;

class Peluquero extends Model
{
    use HasFactory;

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
        return 3;
    }
}
