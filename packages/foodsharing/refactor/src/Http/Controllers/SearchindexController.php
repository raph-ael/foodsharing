<?php
namespace Foodsharing\Refactor\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class SearchindexController extends BaseController
{
    public function getJson($token)
    {
        return Cache::get('searchindex-' . $token).'kjg';
    }
}