<?php

namespace Foodsharing\Installer\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller
{

    public function __construct()
    {
        /*
         * Default Language German
         */
        \App::setLocale('de');
    }

}
