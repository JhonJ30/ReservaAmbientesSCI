<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class RHATest extends TestCase
{
    
class RHUnitTest extends TestCase
{
    /**
     * Verifica que el título de la página de registro sea correcto.
     *
     * @return void
     */
    public function testTituloRegistroAmbiente()
    {
        // Simula la visita a la página de registro
        $response = $this->get('/'); // Cambia '/' por la URL de tu página de registro

        // Verifica que la respuesta contenga el título esperado
        $response->assertSee('REGISTRO DE AMBIENTE');
    }

    /**
     * Verifica que se puedan completar correctamente los campos del formulario.
     *
     * @return void
     */
    public function testCompletarFormulario()
    {
        // Simula el envío de datos al formulario de registro
        $response = $this->post('/store', [
            'unidadAmb' => 'Decanato',
            'ubicacion' => 'Edificio nuevo segundo piso.',
            'capacidad' => '150',
            'tipoAmb' => 'Aula',
            'equipamiento' => 'Proyector',
            'estado' => 'Disponible',
            'nroAmb' => '690B',
            'descripcion' => 'Aula común ubicado en el edificio nuevo.'
        ]); // Cambia '/store' por la URL de la acción de registro en tu aplicación

        // Verifica que el registro se haya realizado correctamente
        $response->assertStatus(200); // Puedes ajustar el código de estado según tu aplicación
    }
}