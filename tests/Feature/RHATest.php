<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RHATest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Prueba de integración para el registro de ambiente.
     *
     * @return void
     */
    public function testRegistroAmbiente()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // Cambia '/' por la URL de tu página de registro
                    ->assertSee('REGISTRO DE AMBIENTE') // Verifica que se muestre el título
                    ->type('unidadAmb', 'Decanato') // Completa el campo Unidad de Ambiente
                    ->type('ubicacion', 'Edificio nuevo segundo piso.') // Completa el campo Ubicación
                    ->type('capacidad', '150') // Completa el campo Capacidad
                    ->select('tipoAmb', 'Aula') // Selecciona el tipo de ambiente
                    ->check('equipamiento', 'Proyector') // Selecciona el equipamiento
                    ->select('estado', 'Disponible') // Selecciona el estado del ambiente
                    ->type('nroAmb', '690B') // Completa el campo Número o Nombre del Ambiente
                    ->type('descripcion', 'Aula común ubicado en el edificio nuevo.') // Completa la descripción
                    ->press('Registrar') // Envía el formulario de registro
                    ->assertPathIs('/') // Verifica que se redirija a la página de inicio después del registro
                    ->assertSee('Ambiente registrado exitosamente'); // Verifica mensaje de éxito o cualquier otro mensaje esperado
        });
    }
}