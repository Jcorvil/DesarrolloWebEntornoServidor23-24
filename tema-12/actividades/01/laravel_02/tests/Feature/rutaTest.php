<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class rutaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example_01(): void
    {
        $response = $this->get('/client');

        $response->assertStatus(200);
    }

    public function test_example_02(): void
    {
        $response = $this->get('/clientes');

        $response->assertStatus(404);

    }
}
