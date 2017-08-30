<?php

namespace App\Repositories;

use App\Models\Storestatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StorestatusRepository
 * @package App\Repositories
 * @version August 30, 2017, 7:43 pm UTC
 *
 * @method Storestatus findWithoutFail($id, $columns = ['*'])
 * @method Storestatus find($id, $columns = ['*'])
 * @method Storestatus first($columns = ['*'])
*/
class StorestatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Storestatus::class;
    }
}
