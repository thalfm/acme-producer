<?php namespace Tests\Repositories;

use App\Models\Instalacao;
use App\Repositories\InstalacaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InstalacaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InstalacaoRepository
     */
    protected $instalacaoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->instalacaoRepo = \App::make(InstalacaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_instalacao()
    {
        $instalacao = Instalacao::factory()->make()->toArray();

        $createdInstalacao = $this->instalacaoRepo->create($instalacao);

        $createdInstalacao = $createdInstalacao->toArray();
        $this->assertArrayHasKey('id', $createdInstalacao);
        $this->assertNotNull($createdInstalacao['id'], 'Created Instalacao must have id specified');
        $this->assertNotNull(Instalacao::find($createdInstalacao['id']), 'Instalacao with given id must be in DB');
        $this->assertModelData($instalacao, $createdInstalacao);
    }

    /**
     * @test read
     */
    public function test_read_instalacao()
    {
        $instalacao = Instalacao::factory()->create();

        $dbInstalacao = $this->instalacaoRepo->find($instalacao->id);

        $dbInstalacao = $dbInstalacao->toArray();
        $this->assertModelData($instalacao->toArray(), $dbInstalacao);
    }

    /**
     * @test update
     */
    public function test_update_instalacao()
    {
        $instalacao = Instalacao::factory()->create();
        $fakeInstalacao = Instalacao::factory()->make()->toArray();

        $updatedInstalacao = $this->instalacaoRepo->update($fakeInstalacao, $instalacao->id);

        $this->assertModelData($fakeInstalacao, $updatedInstalacao->toArray());
        $dbInstalacao = $this->instalacaoRepo->find($instalacao->id);
        $this->assertModelData($fakeInstalacao, $dbInstalacao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_instalacao()
    {
        $instalacao = Instalacao::factory()->create();

        $resp = $this->instalacaoRepo->delete($instalacao->id);

        $this->assertTrue($resp);
        $this->assertNull(Instalacao::find($instalacao->id), 'Instalacao should not exist in DB');
    }
}
