<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Content
 */
class Content extends BaseModel
{
    protected $table = 'fs_content';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'title',
        'body',
        'last_mod'
    ];

    protected $guarded = [];

        
}