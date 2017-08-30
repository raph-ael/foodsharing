<?php

use Faker\Factory as Faker;
use App\Models\Conversation;
use App\Repositories\ConversationRepository;

trait MakeConversationTrait
{
    /**
     * Create fake instance of Conversation and save it in database
     *
     * @param array $conversationFields
     * @return Conversation
     */
    public function makeConversation($conversationFields = [])
    {
        /** @var ConversationRepository $conversationRepo */
        $conversationRepo = App::make(ConversationRepository::class);
        $theme = $this->fakeConversationData($conversationFields);
        return $conversationRepo->create($theme);
    }

    /**
     * Get fake instance of Conversation
     *
     * @param array $conversationFields
     * @return Conversation
     */
    public function fakeConversation($conversationFields = [])
    {
        return new Conversation($this->fakeConversationData($conversationFields));
    }

    /**
     * Get fake data of Conversation
     *
     * @param array $postFields
     * @return array
     */
    public function fakeConversationData($conversationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'locked' => $fake->word,
            'name' => $fake->word,
            'start' => $fake->date('Y-m-d H:i:s'),
            'last' => $fake->date('Y-m-d H:i:s'),
            'last_foodsaver_id' => $fake->randomDigitNotNull,
            'start_foodsaver_id' => $fake->randomDigitNotNull,
            'last_message_id' => $fake->randomDigitNotNull,
            'last_message' => $fake->text,
            'member' => $fake->text
        ], $conversationFields);
    }
}
