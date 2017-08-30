<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Store;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $store = Store::find(1);

        echo $store->team_conversation->name;
        die();

        $area = Area::find(4);

        echo $area->name . ' <<<';
        foreach ($area->stores as $s)
        {
            echo $s->name;
        }

        die();

        return view('frontend.user.dashboard');
    }
}
