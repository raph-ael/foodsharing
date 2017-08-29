<?php

namespace Foodsharing\Installer\Controllers;

use Foodsharing\Installer\Controllers\BaseController;

class WelcomeController extends BaseController
{
    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\View\View
     */

    public function welcome()
    {
        return view('installer::welcome');
    }

}
