<?php

namespace Tests\Feature;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RHTest extends DuskTestCase
{
    use DatabaseMigrations;

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
                    // Otras interacciones y aserciones aquí
                    ->assertSee('Texto en la página');
        });
    }
}