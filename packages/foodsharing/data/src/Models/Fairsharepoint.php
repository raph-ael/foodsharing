<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Fairteiler
 */
class Fairsharepoint extends BaseModel
{
    protected $table = 'fs_fairteiler';

    public $timestamps = false;

    protected $fillable = [
        'bezirk_id',
        'name',
        'picture',
        'status',
        'desc',
        'anschrift',
        'plz',
        'ort',
        'lat',
        'lon',
        'add_date',
        'add_foodsaver'
    ];

    protected $guarded = [];

        
}