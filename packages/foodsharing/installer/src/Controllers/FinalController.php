<?php

namespace Foodsharing\Installer\Controllers;

use Foodsharing\Installer\Controllers\BaseController;
use Foodsharing\Installer\Helpers\InstalledFileManager;
use Foodsharing\Data\Repositories\FoodsaverRepo;

class FinalController extends BaseController
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $fileManager->update();

        return view('installer::finished');
    }

    /**
     * Display installed dummy users
     *
     */
    public function finishdummy(InstalledFileManager $fileManager, FoodsaverRepo $repo_fs)
    {
        $fileManager->update();

        $users = $repo_fs->allOrderBy('id',['id', 'email']);



        return view('installer::finishdummy',[
            'users' => $users
        ]);
    }
}
