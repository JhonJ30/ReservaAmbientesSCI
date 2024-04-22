<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    use HasFactory;
    public function usuarios(){
        return $this->belongsToMany(User::class, 'usuario_materia');
    }

    protected $table = 'materia';
    protected $primaryKey = 'id';

    protected $fillable = [
        'codSis',
        'nivel',
        'nombre',
        'departamento',
        'cantGrupos'
    ];
}
