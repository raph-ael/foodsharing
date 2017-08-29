<?php

namespace Foodsharing\TranslationManager\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * App\UserLocale
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class UserLocales extends Eloquent
{
    protected $table = 'user_locales';

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('translation-manager.default_connection'));
    }
}

