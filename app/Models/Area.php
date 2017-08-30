<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Area",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="parent_id",
 *          description="parent_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="has_children",
 *          description="has_children",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="teaser",
 *          description="teaser",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="desc",
 *          description="desc",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="photo",
 *          description="photo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="master",
 *          description="master",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="mailbox_id",
 *          description="mailbox_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email_pass",
 *          description="email_pass",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email_name",
 *          description="email_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="apply_type",
 *          description="apply_type",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="banana_count",
 *          description="banana_count",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="fetch_count",
 *          description="fetch_count",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="week_num",
 *          description="week_num",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="report_num",
 *          description="report_num",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="stat_fetchweight",
 *          description="stat_fetchweight",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="stat_fetchcount",
 *          description="stat_fetchcount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stat_postcount",
 *          description="stat_postcount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stat_betriebcount",
 *          description="stat_betriebcount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stat_korpcount",
 *          description="stat_korpcount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stat_botcount",
 *          description="stat_botcount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stat_fscount",
 *          description="stat_fscount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stat_fairteilercount",
 *          description="stat_fairteilercount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="conversation_id",
 *          description="conversation_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="moderated",
 *          description="moderated",
 *          type="boolean"
 *      )
 * )
 */
class Area extends Model
{

    public $table = 'fs_bezirk';
    
    public $timestamps = false;



    public $fillable = [
        //'parent_id',
        'has_children',
        'type',
        'teaser',
        'desc',
        'photo',
        'master',
        //'mailbox_id',
        'name',
        'email',
        'email_pass',
        'email_name',
        'apply_type',
        'banana_count',
        'fetch_count',
        'week_num',
        'report_num',
        'stat_last_update',
        'stat_fetchweight',
        'stat_fetchcount',
        'stat_postcount',
        'stat_betriebcount',
        'stat_korpcount',
        'stat_botcount',
        'stat_fscount',
        'stat_fairteilercount',
        //'conversation_id',
        'moderated'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'has_children' => 'boolean',
        'type' => 'boolean',
        'teaser' => 'string',
        'desc' => 'string',
        'photo' => 'string',
        'master' => 'integer',
        'mailbox_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_pass' => 'string',
        'email_name' => 'string',
        'apply_type' => 'boolean',
        'banana_count' => 'boolean',
        'fetch_count' => 'boolean',
        'week_num' => 'boolean',
        'report_num' => 'boolean',
        'stat_fetchcount' => 'integer',
        'stat_postcount' => 'integer',
        'stat_betriebcount' => 'integer',
        'stat_korpcount' => 'integer',
        'stat_botcount' => 'integer',
        'stat_fscount' => 'integer',
        'stat_fairteilercount' => 'integer',
        'conversation_id' => 'integer',
        'moderated' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

   public function stores()
   {
       $this->hasMany('\App\Models\Store','bezirk_id');
   }
}
