<?php

use App\Models\Area;
use App\Repositories\AreaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AreaRepositoryTest extends TestCase
{
    use MakeAreaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AreaRepository
     */
    protected $areaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->areaRepo = App::make(AreaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateArea()
    {
        $area = $this->fakeAreaData();
        $createdArea = $this->areaRepo->create($area);
        $createdArea = $createdArea->toArray();
        $this->assertArrayHasKey('id', $createdArea);
        $this->assertNotNull($createdArea['id'], 'Created Area must have id specified');
        $this->assertNotNull(Area::find($createdArea['id']), 'Area with given id must be in DB');
        $this->assertModelData($area, $createdArea);
    }

    /**
     * @test read
     */
    public function testReadArea()
    {
        $area = $this->makeArea();
        $dbArea = $this->areaRepo->find($area->id);
        $dbArea = $dbArea->toArray();
        $this->assertModelData($area->toArray(), $dbArea);
    }

    /**
     * @test update
     */
    public function testUpdateArea()
    {
        $area = $this->makeArea();
        $fakeArea = $this->fakeAreaData();
        $updatedArea = $this->areaRepo->update($fakeArea, $area->id);
        $this->assertModelData($fakeArea, $updatedArea->toArray());
        $dbArea = $this->areaRepo->find($area->id);
        $this->assertModelData($fakeArea, $dbArea->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteArea()
    {
        $area = $this->makeArea();
        $resp = $this->areaRepo->delete($area->id);
        $this->assertTrue($resp);
        $this->assertNull(Area::find($area->id), 'Area should not exist in DB');
    }
}
