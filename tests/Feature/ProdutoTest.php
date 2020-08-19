<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBuscarprodutos()
    {
        $response = $this->get('/api/produtos');

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testSalvarProduto()
    {
        $response = $this->json(
            'POST',
            '/api/produtos',
            ['nome' => 'Item 02', 'valor' => 50, 'loja_id' => '1', 'ativo' => 1]
        );

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testBuscarLoja()
    {
        $response  = $this->json('GET', 'api/produtos/1');
        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testAtualizarProduto()
    {
        $response = $this->json(
            'PUT',
            '/api/produtos/1',
            ['nome' => 'Produto 02', 'valor' => 100, 'loja_id' => '1', 'ativo' => 1]
        );

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }

    public function testRemoverLoja()
    {
        $response = $this->json(
            'DELETE',
            '/api/produtos/2'
        );

        $response->assertStatus(200)->assertJsonPath('response.cod', 200);
    }
}
