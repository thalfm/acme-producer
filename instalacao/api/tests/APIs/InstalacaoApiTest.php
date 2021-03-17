<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Instalacao;

class InstalacaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_instalacao()
    {
        $instalacao = Instalacao::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/instalacaos', $instalacao
        );

        $this->assertApiResponse($instalacao);
    }

    /**
     * @test
     */
    public function test_read_instalacao()
    {
        $instalacao = Instalacao::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/instalacaos/'.$instalacao->id
        );

        $this->assertApiResponse($instalacao->toArray());
    }

    /**
     * @test
     */
    public function test_update_instalacao()
    {
        $instalacao = Instalacao::factory()->create();
        $editedInstalacao = Instalacao::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/instalacaos/'.$instalacao->id,
            $editedInstalacao
        );

        $this->assertApiResponse($editedInstalacao);
    }

    /**
     * @test
     */
    public function test_delete_instalacao()
    {
        $instalacao = Instalacao::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/instalacaos/'.$instalacao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/instalacaos/'.$instalacao->id
        );

        $this->response->assertStatus(404);
    }
}
