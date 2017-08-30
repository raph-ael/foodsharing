<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Conversation",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="locked",
 *          description="locked",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="last_foodsaver_id",
 *          description="last_foodsaver_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="start_foodsaver_id",
 *          description="start_foodsaver_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="last_message_id",
 *          description="last_message_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="last_message",
 *          description="last_message",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="member",
 *          description="member",
 *          type="string"
 *      )
 * )
 */
class Conversation extends Model
{

    public $table = 'fs_conversation';

    public $timestamps = false;
    /*
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    */


    public $fillable = [
        'locked',
        'name',
        'start',
        'last',
        //'last_foodsaver_id',
        //'start_foodsaver_id',
        //'last_message_id',
        'last_message',
        'member'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'locked' => 'boolean',
        'name' => 'string',
        'last_foodsaver_id' => 'integer',
        'start_foodsaver_id' => 'integer',
        'last_message_id' => 'integer',
        'last_message' => 'string',
        'member' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function store_teams()
    {
        return $this->hasMany(\App\Models\Store::class, 'team_conversation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function store_jumpers()
    {
        return $this->hasMany(\App\Models\Store::class, 'springer_conversation_id');
    }
}
