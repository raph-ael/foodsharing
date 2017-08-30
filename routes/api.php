<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
 * api routes all users
 */
Route::group(['prefix' => 'v1', 'middleware' => 'api'], function () {

    Route::resource('contents', 'ContentAPIController');

    Route::resource('stores', 'StoreAPIController');

    Route::resource('storestatuses', 'StorestatusAPIController');

    Route::resource('areas', 'AreaAPIController');

    Route::resource('storeCategories', 'StoreCategoryAPIController');

});