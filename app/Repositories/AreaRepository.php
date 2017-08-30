<?php

namespace App\Repositories;

use App\Models\Area;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AreaRepository
 * @package App\Repositories
 * @version August 30, 2017, 7:48 pm UTC
 *
 * @method Area findWithoutFail($id, $columns = ['*'])
 * @method Area find($id, $columns = ['*'])
 * @method Area first($columns = ['*'])
*/
class AreaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'has_children',
        'type',
        'teaser',
        'desc',
        'photo',
        'master',
        'mailbox_id',
        'name',
        'email',
        'email_pass',
        'email_name',
        'apply_type',
        'banana_count',
        'fetch_count',
        'week_num',
        'report_num',
        'stat_last_update',
        'stat_fetchweight',
        'stat_fetchcount',
        'stat_postcount',
        'stat_betriebcount',
        'stat_korpcount',
        'stat_botcount',
        'stat_fscount',
        'stat_fairteilercount',
        'conversation_id',
        'moderated'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Area::class;
    }
}
