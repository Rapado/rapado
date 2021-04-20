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
}
