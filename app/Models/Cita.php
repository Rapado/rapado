<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

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
}
