<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Conversation
 */
class Conversation extends BaseModel
{
    protected $table = 'fs_conversation';

    public $timestamps = false;

    protected $fillable = [
        'locked',
        'name',
        'start',
        'last',
        'last_foodsaver_id',
        'start_foodsaver_id',
        'last_message_id',
        'last_message',
        'member'
    ];

    protected $guarded = [];

        
}