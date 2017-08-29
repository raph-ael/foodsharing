<?php

namespace App\Http\Controllers\Backend\Translation;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Translation\TranslationRepository;


/**
 * Class RoleController.
 */
class TranslationController extends Controller
{


    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(TranslationRepository $translation_repo)
    {
        $groups = $translation_repo->listGroups();

        return view('backend.translation.index',[
            'groups' => $groups
        ]);
    }
}
