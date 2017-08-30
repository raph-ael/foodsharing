<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreCategoryApiTest extends TestCase
{
    use MakeStoreCategoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStoreCategory()
    {
        $storeCategory = $this->fakeStoreCategoryData();
        $this->json('POST', '/api/v1/storeCategories', $storeCategory);

        $this->assertApiResponse($storeCategory);
    }

    /**
     * @test
     */
    public function testReadStoreCategory()
    {
        $storeCategory = $this->makeStoreCategory();
        $this->json('GET', '/api/v1/storeCategories/'.$storeCategory->id);

        $this->assertApiResponse($storeCategory->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStoreCategory()
    {
        $storeCategory = $this->makeStoreCategory();
        $editedStoreCategory = $this->fakeStoreCategoryData();

        $this->json('PUT', '/api/v1/storeCategories/'.$storeCategory->id, $editedStoreCategory);

        $this->assertApiResponse($editedStoreCategory);
    }

    /**
     * @test
     */
    public function testDeleteStoreCategory()
    {
        $storeCategory = $this->makeStoreCategory();
        $this->json('DELETE', '/api/v1/storeCategories/'.$storeCategory->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/storeCategories/'.$storeCategory->id);

        $this->assertResponseStatus(404);
    }
}
