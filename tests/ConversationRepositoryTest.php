<?php

use App\Models\Conversation;
use App\Repositories\ConversationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConversationRepositoryTest extends TestCase
{
    use MakeConversationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConversationRepository
     */
    protected $conversationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->conversationRepo = App::make(ConversationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateConversation()
    {
        $conversation = $this->fakeConversationData();
        $createdConversation = $this->conversationRepo->create($conversation);
        $createdConversation = $createdConversation->toArray();
        $this->assertArrayHasKey('id', $createdConversation);
        $this->assertNotNull($createdConversation['id'], 'Created Conversation must have id specified');
        $this->assertNotNull(Conversation::find($createdConversation['id']), 'Conversation with given id must be in DB');
        $this->assertModelData($conversation, $createdConversation);
    }

    /**
     * @test read
     */
    public function testReadConversation()
    {
        $conversation = $this->makeConversation();
        $dbConversation = $this->conversationRepo->find($conversation->id);
        $dbConversation = $dbConversation->toArray();
        $this->assertModelData($conversation->toArray(), $dbConversation);
    }

    /**
     * @test update
     */
    public function testUpdateConversation()
    {
        $conversation = $this->makeConversation();
        $fakeConversation = $this->fakeConversationData();
        $updatedConversation = $this->conversationRepo->update($fakeConversation, $conversation->id);
        $this->assertModelData($fakeConversation, $updatedConversation->toArray());
        $dbConversation = $this->conversationRepo->find($conversation->id);
        $this->assertModelData($fakeConversation, $dbConversation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteConversation()
    {
        $conversation = $this->makeConversation();
        $resp = $this->conversationRepo->delete($conversation->id);
        $this->assertTrue($resp);
        $this->assertNull(Conversation::find($conversation->id), 'Conversation should not exist in DB');
    }
}
