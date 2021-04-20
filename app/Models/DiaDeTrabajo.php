<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDeTrabajo extends Model
{
    use HasFactory;

    public function peluqueria()
    {
        return $this->belongsTo(Peluqueria::class);
    }
}
