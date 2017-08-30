<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContentApiTest extends TestCase
{
    use MakeContentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateContent()
    {
        $content = $this->fakeContentData();
        $this->json('POST', '/api/v1/contents', $content);

        $this->assertApiResponse($content);
    }

    /**
     * @test
     */
    public function testReadContent()
    {
        $content = $this->makeContent();
        $this->json('GET', '/api/v1/contents/'.$content->id);

        $this->assertApiResponse($content->toArray());
    }

    /**
     * @test
     */
    public function testUpdateContent()
    {
        $content = $this->makeContent();
        $editedContent = $this->fakeContentData();

        $this->json('PUT', '/api/v1/contents/'.$content->id, $editedContent);

        $this->assertApiResponse($editedContent);
    }

    /**
     * @test
     */
    public function testDeleteContent()
    {
        $content = $this->makeContent();
        $this->json('DELETE', '/api/v1/contents/'.$content->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/contents/'.$content->id);

        $this->assertResponseStatus(404);
    }
}
