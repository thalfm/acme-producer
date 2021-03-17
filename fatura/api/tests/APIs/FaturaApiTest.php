<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Fatura;

class FaturaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_fatura()
    {
        $fatura = Fatura::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/faturas', $fatura
        );

        $this->assertApiResponse($fatura);
    }

    /**
     * @test
     */
    public function test_read_fatura()
    {
        $fatura = Fatura::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/faturas/'.$fatura->id
        );

        $this->assertApiResponse($fatura->toArray());
    }

    /**
     * @test
     */
    public function test_update_fatura()
    {
        $fatura = Fatura::factory()->create();
        $editedFatura = Fatura::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/faturas/'.$fatura->id,
            $editedFatura
        );

        $this->assertApiResponse($editedFatura);
    }

    /**
     * @test
     */
    public function test_delete_fatura()
    {
        $fatura = Fatura::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/faturas/'.$fatura->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/faturas/'.$fatura->id
        );

        $this->response->assertStatus(404);
    }
}
