<?php

use Faker\Factory as Faker;
use App\Models\StoreCategory;
use App\Repositories\StoreCategoryRepository;

trait MakeStoreCategoryTrait
{
    /**
     * Create fake instance of StoreCategory and save it in database
     *
     * @param array $storeCategoryFields
     * @return StoreCategory
     */
    public function makeStoreCategory($storeCategoryFields = [])
    {
        /** @var StoreCategoryRepository $storeCategoryRepo */
        $storeCategoryRepo = App::make(StoreCategoryRepository::class);
        $theme = $this->fakeStoreCategoryData($storeCategoryFields);
        return $storeCategoryRepo->create($theme);
    }

    /**
     * Get fake instance of StoreCategory
     *
     * @param array $storeCategoryFields
     * @return StoreCategory
     */
    public function fakeStoreCategory($storeCategoryFields = [])
    {
        return new StoreCategory($this->fakeStoreCategoryData($storeCategoryFields));
    }

    /**
     * Get fake data of StoreCategory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStoreCategoryData($storeCategoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word
        ], $storeCategoryFields);
    }
}
