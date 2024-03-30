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
En este ejemplo:

Usamos el método $this->get('/') para simular una solicitud GET a la ruta raíz de la aplicación.
Utilizamos $response->assertStatus(200) para verificar que la respuesta de la solicitud tenga un código de estado HTTP 200, lo que indica una respuesta exitosa.
Usamos $response->assertSee('Texto') para verificar que la respuesta contiene cierto texto en la página renderizada.
Puedes agregar más aserciones según sea necesario para probar otros aspectos de la página o de la respuesta.
Recuerda que debes adaptar las aserciones y las rutas según la estructura y comportamiento específicos de tu aplicación. Estas pruebas unitarias te permiten verificar el comportamiento de tu código PHP al recibir solicitudes HTTP y al renderizar vistas.







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







