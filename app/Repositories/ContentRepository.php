<?php

namespace App\Repositories;

use App\Models\Content;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContentRepository
 * @package App\Repositories
 * @version August 30, 2017, 1:44 pm UTC
 *
 * @method Content findWithoutFail($id, $columns = ['*'])
 * @method Content find($id, $columns = ['*'])
 * @method Content first($columns = ['*'])
*/
class ContentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'title',
        'body',
        'last_mod'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Content::class;
    }
}
