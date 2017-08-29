<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Bell
 */
class Bell extends BaseModel
{
    protected $table = 'fs_bell';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'body',
        'vars',
        'attr',
        'icon',
        'identifier',
        'time',
        'closeable'
    ];

    protected $guarded = [];

        
}