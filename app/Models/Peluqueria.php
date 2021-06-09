<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PeluqueriaEstado;

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

    public function peluqueriaEstados()
    {
        return $this->hasMany(PeluqueriaEstado::class);
    }

    public function diasDeTrabajo()
    {
        return $this->hasMany(DiaDeTrabajo::class);
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function peluqueriaEstado()
    {
        return $this->peluqueriaEstados[0];
    }

    public function estaVerificada()
    {
        return $this->activa;
    }

    public function informacionCompleta()
    {   //si el documento esta cargado, el resto de la informacion deberia estar completa
        return $this->documento != null;
    }

    public function concatenarDireccion($direccion)
    {
        return $direccion['ciudad'] . ', ' . $direccion['calle'] . ' #' . $direccion['numero'];
    }

    public function getArray()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'nombreEncargado' => $this->nombreEncargado,
            'imagen' => $this->logoPath(),
            'documento' => $this->documentoPath(),
            'telefono' => $this->telefono,
            'direccion' => $this->telefono,
            'dadaDeAlta' => $this->created_at->format('d-m-Y'),
            'actualizado' => $this->updated_at->format('d-m-Y'),
        ];
    }

    public function documentoPath()
    {
        return "storage/".$this->documento;
    }

    public function logoPath()
    {
        return "/storage/".$this->logo;
    }

    public function createEstado(){
        $newEstadoPeluqueria = new PeluqueriaEstado();

        $newEstadoPeluqueria->peluqueria_id = $this->id;
        $newEstadoPeluqueria->estado = 'enRevision';
        $newEstadoPeluqueria->save();
    }

    public function updateEstado($estado){
        $this->peluqueriaEstados[0]->estado = $estado;
        $this->peluqueriaEstados[0]->save();
    }

    public function primerosPasos()
    {
        return !$this->tienePeluqueros() || !$this->tieneServicios() || !$this->tieneHorario();
    }

    public function tienePeluqueros()
    {
        return count($this->peluqueros);
    }
    public function tieneServicios()
    {
        return count($this->servicios);
    }
    public function tieneHorario()
    {
        return count($this->diasDeTrabajo);
    }
}
