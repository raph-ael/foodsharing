<?php

namespace App\Repositories\Backend\Translation;

use App\Models\Translation\Translation;
use App\Repositories\BaseRepository;


/**
 * Class RoleRepository.
 */
class TranslationRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Translation::class;

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function listGroups()
    {
        return $this->query()
            ->groupBy('group')
            ->get(['group']);
    }


}
