<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role.
 */
class Translation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'locale', 'group', 'key', 'value', 'saved_value', 'source'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'translations';
    }
}
