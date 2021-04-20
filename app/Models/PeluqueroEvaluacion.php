<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeluqueroEvaluacion extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(cliente::class);
    }

    public function peluquero()
    {
        return $this->belongsTo(Peluquero::class);
    }
}
