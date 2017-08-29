<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Faq
 */
class Faq extends BaseModel
{
    protected $table = 'fs_faq';

    public $timestamps = false;

    protected $fillable = [
        'foodsaver_id',
        'faq_kategorie_id',
        'name',
        'answer'
    ];

    protected $guarded = [];

        
}