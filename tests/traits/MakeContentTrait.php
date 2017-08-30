<?php

use Faker\Factory as Faker;
use App\Models\Content;
use App\Repositories\ContentRepository;

trait MakeContentTrait
{
    /**
     * Create fake instance of Content and save it in database
     *
     * @param array $contentFields
     * @return Content
     */
    public function makeContent($contentFields = [])
    {
        /** @var ContentRepository $contentRepo */
        $contentRepo = App::make(ContentRepository::class);
        $theme = $this->fakeContentData($contentFields);
        return $contentRepo->create($theme);
    }

    /**
     * Get fake instance of Content
     *
     * @param array $contentFields
     * @return Content
     */
    public function fakeContent($contentFields = [])
    {
        return new Content($this->fakeContentData($contentFields));
    }

    /**
     * Get fake data of Content
     *
     * @param array $postFields
     * @return array
     */
    public function fakeContentData($contentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'title' => $fake->word,
            'body' => $fake->text,
            'last_mod' => $fake->date('Y-m-d H:i:s')
        ], $contentFields);
    }
}
