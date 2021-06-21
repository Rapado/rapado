<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PeluqueriaEstado;
use App\Traits\TimeHelper;

class Peluqueria extends Model
{
    use HasFactory;
    use TimeHelper;

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

    public function horario(){
        $horario = [];
        for ($i=0; $i < 7; $i++) {
            array_push($horario, $this->obtenerDia($i + 1));
        }

        return $horario;
    }

    public function obtenerDia($numeroDia)
    {
        $diaDeTrabajo = $this->diasDeTrabajo()->where('dia', $numeroDia)->first();

        return isset($diaDeTrabajo) ? $diaDeTrabajo->toResource() : null;
    }

    public function estaAbierta()
    {
        $hoy = $this->obtenerDia($this->getNumberDay(date('l')));

        if($hoy != null)
            return $hoy->apertura < $this->horaActual() && $this->horaActual() < $hoy->cierre;

        return false;
    }

    public function primerosPasos()
    {
        return !$this->tienePeluqueros() || !$this->tieneServicios() || !$this->tieneHorario();
    }

    public function horarioDeHoy()
    {
        $jornada = $this->obtenerDia($this->getTodayNumber());
        $horaActual = $this->obtenerHoraActualRedondeada(); //6:22 => 6:30, 7:48 => 8:00 10:14 => 10:15
        if($jornada != null){
            $horaActual > $jornada->apertura ?: $horaActual = $jornada->apertura;
            return [ 'apertura' => $jornada->apertura, 'cierre' => $jornada->cierre, 'horaActual' => $horaActual];
        }else{
            return null;
        }
    }

    public function sigueAbierta()
    {
        $horarioDeHoy = $this->horarioDeHoy();

        if($horarioDeHoy == null)
            return false;

        return $horarioDeHoy['horaActual'] < $this->actualizarHora($horarioDeHoy['cierre'], 15);
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
