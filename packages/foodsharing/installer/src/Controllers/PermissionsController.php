<?php

namespace Foodsharing\Installer\Controllers;

use App\Http\Requests;
use Foodsharing\Installer\Controllers\BaseController;
use Foodsharing\Installer\Helpers\PermissionsChecker;

class PermissionsController extends BaseController
{

    /**
     * @var PermissionsChecker
     */
    protected $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        parent::__construct();

        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return view('installer::permissions', compact('permissions'));
    }
}
