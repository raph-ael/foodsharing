<?php

use Faker\Factory as Faker;
use App\Models\Storestatus;
use App\Repositories\StorestatusRepository;

trait MakeStorestatusTrait
{
    /**
     * Create fake instance of Storestatus and save it in database
     *
     * @param array $storestatusFields
     * @return Storestatus
     */
    public function makeStorestatus($storestatusFields = [])
    {
        /** @var StorestatusRepository $storestatusRepo */
        $storestatusRepo = App::make(StorestatusRepository::class);
        $theme = $this->fakeStorestatusData($storestatusFields);
        return $storestatusRepo->create($theme);
    }

    /**
     * Get fake instance of Storestatus
     *
     * @param array $storestatusFields
     * @return Storestatus
     */
    public function fakeStorestatus($storestatusFields = [])
    {
        return new Storestatus($this->fakeStorestatusData($storestatusFields));
    }

    /**
     * Get fake data of Storestatus
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStorestatusData($storestatusFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word
        ], $storestatusFields);
    }
}
