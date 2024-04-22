<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioMateria extends Model
{
    use HasFactory;

    protected $table = 'usuario_materia';
    protected $primaryKey = 'id';

    protected $fillable = [
        'idUsuario',
        'idMateria',
        'nGrupo'
    ];
}
