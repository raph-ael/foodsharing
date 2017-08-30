<?php

namespace App\Repositories;

use App\Models\StoreCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StoreCategoryRepository
 * @package App\Repositories
 * @version August 30, 2017, 8:17 pm UTC
 *
 * @method StoreCategory findWithoutFail($id, $columns = ['*'])
 * @method StoreCategory find($id, $columns = ['*'])
 * @method StoreCategory first($columns = ['*'])
*/
class StoreCategoryRepository extends BaseRepository
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
        return StoreCategory::class;
    }
}
