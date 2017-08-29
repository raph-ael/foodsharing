<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Event
 */
class Event extends BaseModel
{
    protected $table = 'fs_event';

    public $timestamps = false;

    protected $fillable = [
        'foodsaver_id',
        'bezirk_id',
        'location_id',
        'public',
        'name',
        'start',
        'end',
        'description',
        'bot',
        'online'
    ];

    protected $guarded = [];

        
}