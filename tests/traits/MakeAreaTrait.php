<?php

use Faker\Factory as Faker;
use App\Models\Area;
use App\Repositories\AreaRepository;

trait MakeAreaTrait
{
    /**
     * Create fake instance of Area and save it in database
     *
     * @param array $areaFields
     * @return Area
     */
    public function makeArea($areaFields = [])
    {
        /** @var AreaRepository $areaRepo */
        $areaRepo = App::make(AreaRepository::class);
        $theme = $this->fakeAreaData($areaFields);
        return $areaRepo->create($theme);
    }

    /**
     * Get fake instance of Area
     *
     * @param array $areaFields
     * @return Area
     */
    public function fakeArea($areaFields = [])
    {
        return new Area($this->fakeAreaData($areaFields));
    }

    /**
     * Get fake data of Area
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAreaData($areaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'parent_id' => $fake->randomDigitNotNull,
            'has_children' => $fake->word,
            'type' => $fake->word,
            'teaser' => $fake->text,
            'desc' => $fake->text,
            'photo' => $fake->word,
            'master' => $fake->randomDigitNotNull,
            'mailbox_id' => $fake->randomDigitNotNull,
            'name' => $fake->word,
            'email' => $fake->word,
            'email_pass' => $fake->word,
            'email_name' => $fake->word,
            'apply_type' => $fake->word,
            'banana_count' => $fake->word,
            'fetch_count' => $fake->word,
            'week_num' => $fake->word,
            'report_num' => $fake->word,
            'stat_last_update' => $fake->date('Y-m-d H:i:s'),
            'stat_fetchweight' => $fake->word,
            'stat_fetchcount' => $fake->randomDigitNotNull,
            'stat_postcount' => $fake->randomDigitNotNull,
            'stat_betriebcount' => $fake->randomDigitNotNull,
            'stat_korpcount' => $fake->randomDigitNotNull,
            'stat_botcount' => $fake->randomDigitNotNull,
            'stat_fscount' => $fake->randomDigitNotNull,
            'stat_fairteilercount' => $fake->randomDigitNotNull,
            'conversation_id' => $fake->randomDigitNotNull,
            'moderated' => $fake->word
        ], $areaFields);
    }
}
