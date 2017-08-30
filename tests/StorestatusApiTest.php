<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StorestatusApiTest extends TestCase
{
    use MakeStorestatusTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStorestatus()
    {
        $storestatus = $this->fakeStorestatusData();
        $this->json('POST', '/api/v1/storestatuses', $storestatus);

        $this->assertApiResponse($storestatus);
    }

    /**
     * @test
     */
    public function testReadStorestatus()
    {
        $storestatus = $this->makeStorestatus();
        $this->json('GET', '/api/v1/storestatuses/'.$storestatus->id);

        $this->assertApiResponse($storestatus->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStorestatus()
    {
        $storestatus = $this->makeStorestatus();
        $editedStorestatus = $this->fakeStorestatusData();

        $this->json('PUT', '/api/v1/storestatuses/'.$storestatus->id, $editedStorestatus);

        $this->assertApiResponse($editedStorestatus);
    }

    /**
     * @test
     */
    public function testDeleteStorestatus()
    {
        $storestatus = $this->makeStorestatus();
        $this->json('DELETE', '/api/v1/storestatuses/'.$storestatus->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/storestatuses/'.$storestatus->id);

        $this->assertResponseStatus(404);
    }
}
