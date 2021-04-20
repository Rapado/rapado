<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeluqueriaEvaluacion extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(cliente::class);
    }

    public function peluqueria()
    {
        return $this->belongsTo(peluqueria::class);
    }
}
