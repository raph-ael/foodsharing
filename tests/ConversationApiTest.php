<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConversationApiTest extends TestCase
{
    use MakeConversationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateConversation()
    {
        $conversation = $this->fakeConversationData();
        $this->json('POST', '/api/v1/conversations', $conversation);

        $this->assertApiResponse($conversation);
    }

    /**
     * @test
     */
    public function testReadConversation()
    {
        $conversation = $this->makeConversation();
        $this->json('GET', '/api/v1/conversations/'.$conversation->id);

        $this->assertApiResponse($conversation->toArray());
    }

    /**
     * @test
     */
    public function testUpdateConversation()
    {
        $conversation = $this->makeConversation();
        $editedConversation = $this->fakeConversationData();

        $this->json('PUT', '/api/v1/conversations/'.$conversation->id, $editedConversation);

        $this->assertApiResponse($editedConversation);
    }

    /**
     * @test
     */
    public function testDeleteConversation()
    {
        $conversation = $this->makeConversation();
        $this->json('DELETE', '/api/v1/conversations/'.$conversation->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/conversations/'.$conversation->id);

        $this->assertResponseStatus(404);
    }
}
