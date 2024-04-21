<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
    
    protected $table = 'notificacion';
    
    // Si la tabla tiene un campo de autoincremento, especifica su nombre
    protected $primaryKey = 'id';

    // Los campos que se pueden asignar en masa
    protected $fillable = [
        'codReser',
        'mensaje',
        'estado',
    ];
}
