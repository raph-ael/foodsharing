<?php

namespace Foodsharing\Data\Models;

use Foodsharing\Data\Models\BaseModel;

/**
 * Class Foodsaver
 */
class Foodsaver extends BaseModel
{
    protected $table = 'fs_foodsaver';

    public $timestamps = false;

    protected $fillable = [
        'bezirk_id',
        'position',
        'verified',
        'last_pass',
        'new_bezirk',
        'want_new',
        'mailbox_id',
        'rolle',
        'type',
        'plz',
        'stadt',
        'lat',
        'lon',
        'photo',
        'photo_public',
        'email',
        'passwd',
        'name',
        'admin',
        'nachname',
        'anschrift',
        'telefon',
        'tox',
        'homepage',
        'github',
        'twitter',
        'handy',
        'geschlecht',
        'geb_datum',
        'fs_id',
        'anmeldedatum',
        'orgateam',
        'active',
        'data',
        'about_me_public',
        'newsletter',
        'token',
        'infomail_message',
        'last_login',
        'stat_fetchweight',
        'stat_fetchcount',
        'stat_ratecount',
        'stat_rating',
        'stat_postcount',
        'stat_buddycount',
        'stat_bananacount',
        'stat_fetchrate',
        'sleep_status',
        'sleep_from',
        'sleep_until',
        'sleep_msg',
        'last_mid',
        'option',
        'beta',
        'fs_password',
        'quiz_rolle',
        'contact_public'
    ];

    protected $guarded = [];

        
}