<?php

use App\Models\StoreCategory;
use App\Repositories\StoreCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreCategoryRepositoryTest extends TestCase
{
    use MakeStoreCategoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StoreCategoryRepository
     */
    protected $storeCategoryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->storeCategoryRepo = App::make(StoreCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStoreCategory()
    {
        $storeCategory = $this->fakeStoreCategoryData();
        $createdStoreCategory = $this->storeCategoryRepo->create($storeCategory);
        $createdStoreCategory = $createdStoreCategory->toArray();
        $this->assertArrayHasKey('id', $createdStoreCategory);
        $this->assertNotNull($createdStoreCategory['id'], 'Created StoreCategory must have id specified');
        $this->assertNotNull(StoreCategory::find($createdStoreCategory['id']), 'StoreCategory with given id must be in DB');
        $this->assertModelData($storeCategory, $createdStoreCategory);
    }

    /**
     * @test read
     */
    public function testReadStoreCategory()
    {
        $storeCategory = $this->makeStoreCategory();
        $dbStoreCategory = $this->storeCategoryRepo->find($storeCategory->id);
        $dbStoreCategory = $dbStoreCategory->toArray();
        $this->assertModelData($storeCategory->toArray(), $dbStoreCategory);
    }

    /**
     * @test update
     */
    public function testUpdateStoreCategory()
    {
        $storeCategory = $this->makeStoreCategory();
        $fakeStoreCategory = $this->fakeStoreCategoryData();
        $updatedStoreCategory = $this->storeCategoryRepo->update($fakeStoreCategory, $storeCategory->id);
        $this->assertModelData($fakeStoreCategory, $updatedStoreCategory->toArray());
        $dbStoreCategory = $this->storeCategoryRepo->find($storeCategory->id);
        $this->assertModelData($fakeStoreCategory, $dbStoreCategory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStoreCategory()
    {
        $storeCategory = $this->makeStoreCategory();
        $resp = $this->storeCategoryRepo->delete($storeCategory->id);
        $this->assertTrue($resp);
        $this->assertNull(StoreCategory::find($storeCategory->id), 'StoreCategory should not exist in DB');
    }
}
