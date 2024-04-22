<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')
                ->nullable()
                ->constrained('users');
            $table->foreignId('idMateria')
                ->nullable()
                ->constrained('materia');
            $table->string('nGrupo', 3);
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
        Schema::dropIfExists('usuario_materia');
    }
}
