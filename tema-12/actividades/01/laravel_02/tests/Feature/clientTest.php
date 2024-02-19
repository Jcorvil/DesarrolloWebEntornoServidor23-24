<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class clientTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_edit(): void
    {
        $response = $this->get('/client/edit/5');

        $response->assertStatus(200);
        $response->assertSee('Cliente Editado: 5');
    }

    public function test_delete_1(): void
    {
        $response = $this->get('/client/delete/1');

        $response->assertStatus(200);
        $response->assertSee('Eliminar el cliente 1');
    }

    public function test_delete_2(): void
    {
        $response = $this->get('/client/delete/1/2');

        $response->assertStatus(200);
        $response->assertSee('Eliminar los clientes del 1 al 2');
    }

    public function test_new(): void
    {
        $response = $this->get('/client/new');

        $response->assertStatus(200);
        $response->assertSee('Creando el cliente');
    }

    public function test_show(): void
    {
        $response = $this->get('/client/show/5');

        $response->assertStatus(200);
        $response->assertSee('Mostrando el cliente 5');
    }

}
