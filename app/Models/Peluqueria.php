<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peluqueria extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peluqueros()
    {
        return $this->hasMany(Peluquero::class);
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'peluqueria_favoritas');
    }

    public function evaluaciones()
    {
        return $this->hasMany(PeluqueriaEvaluacion::class);
    }

    public function administradores()
    {
        return $this->hasMany(PeluqueriaEstado::class);
    }

    public function calendario()
    {
        return $this->hasMany(DiaDeTrabajo::class);
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function getArray()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'nombreEncargado' => $this->nombreEncargado,
            'imagen' => $this->imagen,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'direccion' => $this->telefono,
            'dadaDeAlta' => $this->created_at->format('d-m-Y'),
            'actualizado' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
