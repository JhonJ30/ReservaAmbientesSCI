<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Reservar;
use App\Models\Ambientes;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function materias(){
        return $this->belongsToMany(Materias::class, 'usuario_materia');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name', 'email', 'password',
        'codSis',
        'rol',
        'nombre',
        'apellido',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservas()
{
    return $this->hasMany(Reservar::class, 'codUser');
}
public function reservas1()
{
    return $this->hasMany(Ambientes::class, 'codUser');
}
}
