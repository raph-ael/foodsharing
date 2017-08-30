<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Store",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="betrieb_status_id",
 *          description="betrieb_status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="bezirk_id",
 *          description="bezirk_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="added",
 *          description="added",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="plz",
 *          description="plz",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="stadt",
 *          description="stadt",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lat",
 *          description="lat",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lon",
 *          description="lon",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kette_id",
 *          description="kette_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="betrieb_kategorie_id",
 *          description="betrieb_kategorie_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="str",
 *          description="str",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="hsnr",
 *          description="hsnr",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status_date",
 *          description="status_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="ansprechpartner",
 *          description="ansprechpartner",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="telefon",
 *          description="telefon",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="fax",
 *          description="fax",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="begin",
 *          description="begin",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="besonderheiten",
 *          description="besonderheiten",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="public_info",
 *          description="public_info",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="public_time",
 *          description="public_time",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="ueberzeugungsarbeit",
 *          description="ueberzeugungsarbeit",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="presse",
 *          description="presse",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="sticker",
 *          description="sticker",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="abholmenge",
 *          description="abholmenge",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="team_status",
 *          description="team_status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="prefetchtime",
 *          description="prefetchtime",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="team_conversation_id",
 *          description="team_conversation_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="springer_conversation_id",
 *          description="springer_conversation_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Store extends Model
{

    protected $table = 'fs_betrieb';

    public $timestamps = false;


    
    //const CREATED_AT = 'created_at';
    //const UPDATED_AT = 'updated_at';



    public $fillable = [
        //'betrieb_status_id',
        //'bezirk_id',
        'added',
        'plz',
        'stadt',
        'lat',
        'lon',
        //'kette_id',
        //'betrieb_kategorie_id',
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
        //'team_conversation_id',
        //'springer_conversation_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        //'id' => 'integer',
        //'betrieb_status_id' => 'integer',
        //'bezirk_id' => 'integer',
        'added' => 'date',
        'plz' => 'string',
        'stadt' => 'string',
        'lat' => 'string',
        'lon' => 'string',
        'kette_id' => 'integer',
        //'betrieb_kategorie_id' => 'integer',
        'name' => 'string',
        'str' => 'string',
        'hsnr' => 'string',
        'status_date' => 'date',
        'status' => 'boolean',
        'ansprechpartner' => 'string',
        'telefon' => 'string',
        'fax' => 'string',
        'email' => 'string',
        'begin' => 'date',
        'besonderheiten' => 'string',
        'public_info' => 'string',
        'public_time' => 'boolean',
        'ueberzeugungsarbeit' => 'boolean',
        'presse' => 'boolean',
        'sticker' => 'boolean',
        'abholmenge' => 'boolean',
        'team_status' => 'boolean',
        'prefetchtime' => 'integer',
        //'team_conversation_id' => 'integer',
        //'springer_conversation_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function storestatus()
    {
        return $this->belongsTo('\App\Models\Storestatus', 'betrieb_status_id','id');
    }

    public function area()
    {
        return $this->belongsTo('\App\Models\Area', 'bezirk_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo('\App\Models\StoreCategory', 'betrieb_kategorie_id');
    }

    /*
    public function team_conversation()
    {
        return $this->belongsTo('\App\Models\Conversation', 'team_conversation_id');
    }

    public function jumper_conversation()
    {
        return $this->belongsTo('\App\Models\Conversation', 'springer_conversation_id');
    }
    */

}
