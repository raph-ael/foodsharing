<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Bezirk
 */
class Area extends BaseModel
{
    protected $table = 'fs_bezirk';

    public $timestamps = false;

    protected $fillable = [
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

    protected $guarded = [];

        
}