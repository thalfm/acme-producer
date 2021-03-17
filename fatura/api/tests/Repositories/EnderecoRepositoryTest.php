<?php namespace Tests\Repositories;

use App\Models\Endereco;
use App\Repositories\EnderecoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EnderecoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EnderecoRepository
     */
    protected $enderecoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->enderecoRepo = \App::make(EnderecoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_endereco()
    {
        $endereco = Endereco::factory()->make()->toArray();

        $createdEndereco = $this->enderecoRepo->create($endereco);

        $createdEndereco = $createdEndereco->toArray();
        $this->assertArrayHasKey('id', $createdEndereco);
        $this->assertNotNull($createdEndereco['id'], 'Created Endereco must have id specified');
        $this->assertNotNull(Endereco::find($createdEndereco['id']), 'Endereco with given id must be in DB');
        $this->assertModelData($endereco, $createdEndereco);
    }

    /**
     * @test read
     */
    public function test_read_endereco()
    {
        $endereco = Endereco::factory()->create();

        $dbEndereco = $this->enderecoRepo->find($endereco->id);

        $dbEndereco = $dbEndereco->toArray();
        $this->assertModelData($endereco->toArray(), $dbEndereco);
    }

    /**
     * @test update
     */
    public function test_update_endereco()
    {
        $endereco = Endereco::factory()->create();
        $fakeEndereco = Endereco::factory()->make()->toArray();

        $updatedEndereco = $this->enderecoRepo->update($fakeEndereco, $endereco->id);

        $this->assertModelData($fakeEndereco, $updatedEndereco->toArray());
        $dbEndereco = $this->enderecoRepo->find($endereco->id);
        $this->assertModelData($fakeEndereco, $dbEndereco->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_endereco()
    {
        $endereco = Endereco::factory()->create();

        $resp = $this->enderecoRepo->delete($endereco->id);

        $this->assertTrue($resp);
        $this->assertNull(Endereco::find($endereco->id), 'Endereco should not exist in DB');
    }
}
