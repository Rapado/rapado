<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peluqueriasFavoritas()
    {
        return $this->belongsToMany(Peluqueria::class, 'peluqueria_favoritas');
    }

    public function evaluacionesDePeluquerias()
    {
        return $this->hasMany(PeluqueriaEvaluacion::class);
    }

    public function evaluacionesAPeluqueros()
    {
        return $this->hasMany(PeluqueroEvaluacion::class);
    }

}
