<?php

namespace App\Repositories;

use App\Models\Conversation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ConversationRepository
 * @package App\Repositories
 * @version August 30, 2017, 8:15 pm UTC
 *
 * @method Conversation findWithoutFail($id, $columns = ['*'])
 * @method Conversation find($id, $columns = ['*'])
 * @method Conversation first($columns = ['*'])
*/
class ConversationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'locked',
        'name',
        'start',
        'last',
        'last_foodsaver_id',
        'start_foodsaver_id',
        'last_message_id',
        'last_message',
        'member'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Conversation::class;
    }
}
