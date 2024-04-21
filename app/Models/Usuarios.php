<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $fillable = [
        'codSis',
        'rol',
        'nombre',
        'apellido',
        'correo',
        'contraseña'
    ];
}
