<?php

use App\Models\Storestatus;
use App\Repositories\StorestatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StorestatusRepositoryTest extends TestCase
{
    use MakeStorestatusTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StorestatusRepository
     */
    protected $storestatusRepo;

    public function setUp()
    {
        parent::setUp();
        $this->storestatusRepo = App::make(StorestatusRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStorestatus()
    {
        $storestatus = $this->fakeStorestatusData();
        $createdStorestatus = $this->storestatusRepo->create($storestatus);
        $createdStorestatus = $createdStorestatus->toArray();
        $this->assertArrayHasKey('id', $createdStorestatus);
        $this->assertNotNull($createdStorestatus['id'], 'Created Storestatus must have id specified');
        $this->assertNotNull(Storestatus::find($createdStorestatus['id']), 'Storestatus with given id must be in DB');
        $this->assertModelData($storestatus, $createdStorestatus);
    }

    /**
     * @test read
     */
    public function testReadStorestatus()
    {
        $storestatus = $this->makeStorestatus();
        $dbStorestatus = $this->storestatusRepo->find($storestatus->id);
        $dbStorestatus = $dbStorestatus->toArray();
        $this->assertModelData($storestatus->toArray(), $dbStorestatus);
    }

    /**
     * @test update
     */
    public function testUpdateStorestatus()
    {
        $storestatus = $this->makeStorestatus();
        $fakeStorestatus = $this->fakeStorestatusData();
        $updatedStorestatus = $this->storestatusRepo->update($fakeStorestatus, $storestatus->id);
        $this->assertModelData($fakeStorestatus, $updatedStorestatus->toArray());
        $dbStorestatus = $this->storestatusRepo->find($storestatus->id);
        $this->assertModelData($fakeStorestatus, $dbStorestatus->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStorestatus()
    {
        $storestatus = $this->makeStorestatus();
        $resp = $this->storestatusRepo->delete($storestatus->id);
        $this->assertTrue($resp);
        $this->assertNull(Storestatus::find($storestatus->id), 'Storestatus should not exist in DB');
    }
}
