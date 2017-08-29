<?php namespace Foodsharing\Data\Repositories;

use Foodsharing\Data\Models\Foodsaver;
use Foodsharing\Data\Repository;
use Foodsharing\Refactor\Helper;

class FoodsaverRepo extends Repository {

    public function model() {
        return 'Foodsharing\Data\Models\Foodsaver';
    }

    public function addNew($email, $password, $name, $surname, $role = 1, $area_id = 1) {

        $token = uniqid('',true);

        $foodsaver = new Foodsaver();

        /*
         * Foodsaver Role
         * 1 = ...
         */
        $foodsaver->email = $email;
        $foodsaver->rolle = $role;
        $foodsaver->token = $token;
        $foodsaver->name = $name;
        $foodsaver->nachname = $surname;
        $foodsaver->passwd = Helper::encryptMd5($email, $password);
        $foodsaver->bezirk_id = $area_id;

        $foodsaver->save();

        return $foodsaver;
        /*

				`type`,
				`active`,
				`plz`,
				`email`,
				`passwd`,
				`anschrift`,
				`telefon`,
				`newsletter`,
				`geschlecht`,
				`anmeldedatum`,
				`stadt`,
				`lat`,
				`lon`,
				`token`,
				`photo`
        */

    }
}