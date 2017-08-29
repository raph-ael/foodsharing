<?php

namespace Foodsharing\Installer\Controllers;

use Foodsharing\Installer\Controllers\BaseController;
use Foodsharing\Installer\Helpers\RequirementsChecker;

class RequirementsController extends BaseController
{

    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        parent::__construct();

        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return \Illuminate\View\View
     */
    public function requirements()
    {
        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return view('installer::requirements', compact('requirements'));
    }
}
