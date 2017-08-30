<?php

use Faker\Factory as Faker;
use App\Models\Store;
use App\Repositories\StoreRepository;

trait MakeStoreTrait
{
    /**
     * Create fake instance of Store and save it in database
     *
     * @param array $storeFields
     * @return Store
     */
    public function makeStore($storeFields = [])
    {
        /** @var StoreRepository $storeRepo */
        $storeRepo = App::make(StoreRepository::class);
        $theme = $this->fakeStoreData($storeFields);
        return $storeRepo->create($theme);
    }

    /**
     * Get fake instance of Store
     *
     * @param array $storeFields
     * @return Store
     */
    public function fakeStore($storeFields = [])
    {
        return new Store($this->fakeStoreData($storeFields));
    }

    /**
     * Get fake data of Store
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStoreData($storeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'betrieb_status_id' => $fake->randomDigitNotNull,
            'bezirk_id' => $fake->randomDigitNotNull,
            'added' => $fake->word,
            'plz' => $fake->word,
            'stadt' => $fake->word,
            'lat' => $fake->word,
            'lon' => $fake->word,
            'kette_id' => $fake->randomDigitNotNull,
            'betrieb_kategorie_id' => $fake->randomDigitNotNull,
            'name' => $fake->word,
            'str' => $fake->word,
            'hsnr' => $fake->word,
            'status_date' => $fake->word,
            'status' => $fake->word,
            'ansprechpartner' => $fake->word,
            'telefon' => $fake->word,
            'fax' => $fake->word,
            'email' => $fake->word,
            'begin' => $fake->word,
            'besonderheiten' => $fake->text,
            'public_info' => $fake->word,
            'public_time' => $fake->word,
            'ueberzeugungsarbeit' => $fake->word,
            'presse' => $fake->word,
            'sticker' => $fake->word,
            'abholmenge' => $fake->word,
            'team_status' => $fake->word,
            'prefetchtime' => $fake->randomDigitNotNull,
            'team_conversation_id' => $fake->randomDigitNotNull,
            'springer_conversation_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $storeFields);
    }
}
