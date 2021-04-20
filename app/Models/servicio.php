<?php

namespace App\Models;

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
}
