<?php
/*
 * Routes for refactoring
 * get old stuff refactored always with prefix route /old/myRoute
 * load all Controllers from Namespace
 */
Route::group([
    'prefix' => 'old',
    'namespace' => '\\Foodsharing\\Refactor\\Http\\Controllers'],
    function ()
    {

        /*
         * route to get user specific searchindex json as json file
         */
        Route::get('searchindex/{token}','SearchindexController@getJson');
    }
);