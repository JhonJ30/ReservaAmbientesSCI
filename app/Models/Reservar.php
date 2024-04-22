<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservar extends Model
{
    use HasFactory;
    protected $table = 'reserva';
    
    // Si la tabla tiene un campo de autoincremento, especifica su nombre
    protected $primaryKey = 'id';

    // Los campos que se pueden asignar en masa
    protected $fillable = [
        'codUser',
        /*'codAmb',*/
        'nroAmb',
        'Materia', 
        'horaInicio',
        'horaFin',
        'Actividad',
        'fecha',
       /* 'estado',*/
    ];
    public function usuario()
{
    return $this->belongsTo(User::class, 'codUser');
}
}
