<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Basket
 */
class Basket extends BaseModel
{
    protected $table = 'fs_basket';

    public $timestamps = false;

    protected $fillable = [
        'foodsaver_id',
        'status',
        'time',
        'until',
        'fetchtime',
        'description',
        'picture',
        'tel',
        'handy',
        'contact_type',
        'location_type',
        'weight',
        'lat',
        'lon',
        'bezirk_id',
        'fs_id',
        'appost'
    ];

    protected $guarded = [];

        
}