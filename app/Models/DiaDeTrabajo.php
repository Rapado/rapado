<?php

namespace App\Models;

use App\Http\Resources\DiaDeTrabajoResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDeTrabajo extends Model
{
    use HasFactory;

    public function peluqueria()
    {
        return $this->belongsTo(Peluqueria::class);
    }

    public function toResource()
    {
        return new DiaDeTrabajoResource($this);
    }

    // public function getAperturaAttribute($value)
    // {
    //     return substr($value, 0, strlen($value) - 3); //09:59:56 => 09:59
    // }

    // public function getCierreAttribute($value)
    // {
    //     return substr($value, 0, strlen($value) - 3);
    // }
}
