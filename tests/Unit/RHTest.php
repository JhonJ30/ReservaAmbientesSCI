<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class RHTest extends TestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegistroHorarios()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->select('#tipo-ambiente', 'aula')
                    ->waitFor('#ambiente')
                    ->select('#ambiente', 'Laboratorio')
                    ->type('#hora-inicio', '08:00')
                    ->keys('#hora-inicio', '{tab}') // Cambiar al siguiente campo
                    ->pause(500) // Pausa para esperar cálculos
                    ->assertInputValue('#hora-fin', '09:00') // Comprobar que el cálculo sea correcto
                    ->type('#intervalo', '15')
                    ->press('Registrar')
                    ->assertSee('Registro exitoso'); // Verificar mensaje de éxito
        });
    }
}