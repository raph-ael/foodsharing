<?php

namespace Foodsharing\Installer\Controllers;

use Foodsharing\Installer\Controllers\BaseController;
use Foodsharing\Installer\Helpers\DatabaseManager;

class DummydataController extends BaseController
{

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function dummydata()
    {
        $response = $this->databaseManager->seedDummyData();

        return redirect()->route('Installer::finaldummy')
                         ->with(['message' => $response]);
    }
}
