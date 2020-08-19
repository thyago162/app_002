<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LojaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBuscarLojas()
    {
        $response = $this->get('/api/lojas');

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testSalvarLoja()
    {
        $response = $this->json(
            'POST',
            '/api/lojas',
            ['nome_loja' => 'Loja teste', 'email' => 'email@lojateste.com.br']
        );

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testBuscarLoja()
    {
        $response  = $this->json('GET', 'api/lojas/1');
        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testAtualizarLoja()
    {
        $response = $this->json(
            'PUT',
            '/api/lojas/1',
            ['nome_loja' => 'Contabil Soluções', 'email' => 'email@contabil.com.br']
        );

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testRemoverLoja()
    {
        $response = $this->json(
            'DELETE',
            '/api/lojas/2'
        );

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }
}
