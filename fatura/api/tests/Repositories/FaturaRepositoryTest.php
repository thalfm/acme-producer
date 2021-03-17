<?php namespace Tests\Repositories;

use App\Models\Fatura;
use App\Repositories\FaturaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FaturaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FaturaRepository
     */
    protected $faturaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->faturaRepo = \App::make(FaturaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_fatura()
    {
        $fatura = Fatura::factory()->make()->toArray();

        $createdFatura = $this->faturaRepo->create($fatura);

        $createdFatura = $createdFatura->toArray();
        $this->assertArrayHasKey('id', $createdFatura);
        $this->assertNotNull($createdFatura['id'], 'Created Fatura must have id specified');
        $this->assertNotNull(Fatura::find($createdFatura['id']), 'Fatura with given id must be in DB');
        $this->assertModelData($fatura, $createdFatura);
    }

    /**
     * @test read
     */
    public function test_read_fatura()
    {
        $fatura = Fatura::factory()->create();

        $dbFatura = $this->faturaRepo->find($fatura->id);

        $dbFatura = $dbFatura->toArray();
        $this->assertModelData($fatura->toArray(), $dbFatura);
    }

    /**
     * @test update
     */
    public function test_update_fatura()
    {
        $fatura = Fatura::factory()->create();
        $fakeFatura = Fatura::factory()->make()->toArray();

        $updatedFatura = $this->faturaRepo->update($fakeFatura, $fatura->id);

        $this->assertModelData($fakeFatura, $updatedFatura->toArray());
        $dbFatura = $this->faturaRepo->find($fatura->id);
        $this->assertModelData($fakeFatura, $dbFatura->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_fatura()
    {
        $fatura = Fatura::factory()->create();

        $resp = $this->faturaRepo->delete($fatura->id);

        $this->assertTrue($resp);
        $this->assertNull(Fatura::find($fatura->id), 'Fatura should not exist in DB');
    }
}
