<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'tipo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function peluqueria()
    {
        return $this->hasOne(Peluqueria::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function getName()
    {
        switch ($this->tipo) {
            case 'cliente':
                return $this->cliente->nombre;
            case 'peluqueria':
                return $this->peluqueria->nombre;
            case 'admin':
                return $this->administrador->nombre;
        }
    }

    public function getHomePage()
    {
        switch ($this->tipo) {
            case 'cliente':
                return 'dashboard';
            case 'peluqueria':
                return 'peluqueria/dashboard';
            case 'admin':
                return 'admin/dashboard';
        }
    }
}
