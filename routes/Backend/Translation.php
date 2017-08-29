<?php

/**
 * All route names are prefixed with 'admin.access'.
 */

\Route::group(['middleware' => 'web', 'prefix' => 'translation', 'as' => 'translation.', 'namespace' => 'Translation'], function () {


    \Route::get('index', 'TranslationController@index')->name('index');
    
});
