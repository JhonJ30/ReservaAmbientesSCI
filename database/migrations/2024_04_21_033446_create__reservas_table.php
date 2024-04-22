<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Reserva', function (Blueprint $table) {
            $table->id();
            $table->string('codUser');
            $table->string('codAmb');
            $table->string('Materia');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->string('Actividad');
            $table->date('Fecha');
           /*$table->string('Estado');*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_reservas');
    }
}
