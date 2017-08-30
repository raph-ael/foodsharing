<?php

namespace App\Repositories;

use App\Models\Store;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StoreRepository
 * @package App\Repositories
 * @version August 30, 2017, 7:13 pm UTC
 *
 * @method Store findWithoutFail($id, $columns = ['*'])
 * @method Store find($id, $columns = ['*'])
 * @method Store first($columns = ['*'])
*/
class StoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Store::class;
    }
}
