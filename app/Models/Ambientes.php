<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambientes extends Model
{
    use HasFactory;
    protected $table = 'ambiente';
    
    // Si la tabla tiene un campo de autoincremento, especifica su nombre
    protected $primaryKey = 'id';

    // Los campos que se pueden asignar en masa
    protected $fillable = [
        'unidadAmb',
        'tipoAmb',
        'nroAmb',
        'ubicacion', 
        'equipamiento',
        'capacidad',
        'descripcion',
        'estado',
    ];
  
}
