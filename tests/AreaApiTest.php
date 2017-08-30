<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AreaApiTest extends TestCase
{
    use MakeAreaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateArea()
    {
        $area = $this->fakeAreaData();
        $this->json('POST', '/api/v1/areas', $area);

        $this->assertApiResponse($area);
    }

    /**
     * @test
     */
    public function testReadArea()
    {
        $area = $this->makeArea();
        $this->json('GET', '/api/v1/areas/'.$area->id);

        $this->assertApiResponse($area->toArray());
    }

    /**
     * @test
     */
    public function testUpdateArea()
    {
        $area = $this->makeArea();
        $editedArea = $this->fakeAreaData();

        $this->json('PUT', '/api/v1/areas/'.$area->id, $editedArea);

        $this->assertApiResponse($editedArea);
    }

    /**
     * @test
     */
    public function testDeleteArea()
    {
        $area = $this->makeArea();
        $this->json('DELETE', '/api/v1/areas/'.$area->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/areas/'.$area->id);

        $this->assertResponseStatus(404);
    }
}
