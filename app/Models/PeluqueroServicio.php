<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeluqueroServicio extends Model
{
    use HasFactory;

    protected $table = 'peluquero_servicio';

    public function peluquero()
    {
        return $this->belongsTo(Peluquero::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
