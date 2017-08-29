<?php

namespace Foodsharing\Installer\Controllers;

use Foodsharing\Installer\Controllers\BaseController;
use Foodsharing\Installer\Helpers\DatabaseManager;

class DatabaseController extends BaseController
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
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('Installer::final')
                         ->with(['message' => $response]);
    }
}
