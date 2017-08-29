<?php

namespace Foodsharing\Installer\Controllers;

use Foodsharing\Installer\Controllers\BaseController;
use Foodsharing\Installer\Helpers\EnvironmentManager;
use Foodsharing\Installer\Request\UpdateRequest;

/**
 * Class EnvironmentController
 * @package Foodsharing\Installer\Controllers
 */
class EnvironmentController extends BaseController
{

    /**
     * @var EnvironmentManager
     */
    protected $environmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        parent::__construct();

        $this->environmentManager = $environmentManager;
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environment()
    {
        $envConfig = $this->environmentManager->getEnvContent();

        $vars = compact('envConfig');

        $vars['db_host'] = env('DB_HOST','localhost');
        $vars['db_password'] = env('DB_PASSWORD','');
        $vars['db_name'] = env('DB_DATABASE','foodsharing');
        $vars['db_username'] = env('DB_USERNAME','homestead');

        return view('installer::environment', $vars);
    }

    /**
     * @param UpdateRequest $request
     * @return string
     */
    public function save(UpdateRequest $request)
    {

        $message = $this->environmentManager->saveFile($request);
        return $message;

    }

}
