<?php

namespace Tests\Feature;

use Tests\TestCase;

class RHTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistroHorarios()
    {
        // Realizar la solicitud GET a la ruta '/'
        $response = $this->get('/');

        // Verificar que la respuesta tenga un código de estado exitoso (200)
        $response->assertStatus(200);

        // Verificar que la vista contenga el texto 'Tipo de Ambiente'
        $response->assertSee('Tipo de Ambiente');

        // Verificar que la vista contenga el texto 'Ambiente'
        $response->assertSee('Ambiente');

        // Agregar más aserciones según sea necesario para la prueba
    }
}





<?php

namespace Tests\Feature;

use Tests\TestCase;

class RHTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistroHorarios()
    {
        // Realizar la solicitud GET a la ruta '/'
        $response = $this->get('/');

        // Verificar que la respuesta tenga un código de estado exitoso (200)
        $response->assertStatus(200);

        // Verificar que la vista contenga el texto 'Tipo de Ambiente'
        $response->assertSee('Tipo de Ambiente');

        // Verificar que la vista contenga el texto 'Ambiente'
        $response->assertSee('Ambiente');

        // Agregar más aserciones según sea necesario para la prueba
    }
}







