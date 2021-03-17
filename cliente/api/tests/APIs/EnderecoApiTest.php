<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Endereco;

class EnderecoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_endereco()
    {
        $endereco = Endereco::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/enderecos', $endereco
        );

        $this->assertApiResponse($endereco);
    }

    /**
     * @test
     */
    public function test_read_endereco()
    {
        $endereco = Endereco::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/enderecos/'.$endereco->id
        );

        $this->assertApiResponse($endereco->toArray());
    }

    /**
     * @test
     */
    public function test_update_endereco()
    {
        $endereco = Endereco::factory()->create();
        $editedEndereco = Endereco::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/enderecos/'.$endereco->id,
            $editedEndereco
        );

        $this->assertApiResponse($editedEndereco);
    }

    /**
     * @test
     */
    public function test_delete_endereco()
    {
        $endereco = Endereco::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/enderecos/'.$endereco->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/enderecos/'.$endereco->id
        );

        $this->response->assertStatus(404);
    }
}
