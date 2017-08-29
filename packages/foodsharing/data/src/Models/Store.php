<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Betrieb
 */
class Store extends BaseModel
{
    protected $table = 'fs_betrieb';

    public $timestamps = false;

    protected $fillable = [
        'betrieb_status_id',
        'bezirk_id',
        'added',
        'plz',
        'stadt',
        'lat',
        'lon',
        'kette_id',
        'betrieb_kategorie_id',
        'name',
        'str',
        'hsnr',
        'status_date',
        'status',
        'ansprechpartner',
        'telefon',
        'fax',
        'email',
        'begin',
        'besonderheiten',
        'public_info',
        'public_time',
        'ueberzeugungsarbeit',
        'presse',
        'sticker',
        'abholmenge',
        'team_status',
        'prefetchtime',
        'team_conversation_id',
        'springer_conversation_id'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('Foodsharing\Data\Models\Area', 'bezirk_id', 'id');
    }


}