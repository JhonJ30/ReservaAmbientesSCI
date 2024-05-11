<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'bitacora';
    
    // Si la tabla tiene un campo de autoincremento, especifica su nombre
    protected $primaryKey = 'id';

    // Los campos que se pueden asignar en masa
    protected $fillable = [
        'fecha',
        'hora',
        'id_Usuario',
        'evento',
        'tabla',
        'id_Registro',
        'dato_modificado',
    ];
}
