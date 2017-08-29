<?php namespace Foodsharing\Data\Repositories;

use Foodsharing\Data\Repository;

class StoreRepo extends Repository {

    public function model() {
        return 'Foodsharing\Data\Models\Store';
    }
}