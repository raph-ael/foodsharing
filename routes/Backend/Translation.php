<?php

/**
 * All route names are prefixed with 'admin.access'.
 */

\Route::group(['middleware' => 'web', 'prefix' => 'translations','as' => 'translation.'], function () {
    \Route::get('view/{group?}', '\\Foodsharing\\TranslationManager\\Controller@getView');

    //deprecated: \Route::controller('admin/translations', 'Controller');
    \Route::get('/', '\\Foodsharing\\TranslationManager\\Controller@getIndex')->name('index');
    \Route::get('connection', '\\Foodsharing\\TranslationManager\\Controller@getConnection');
    \Route::get('import', '\\Foodsharing\\TranslationManager\\Controller@getImport');
    \Route::get('index', '\\Foodsharing\\TranslationManager\\Controller@getIndex');
    \Route::get('interface_locale', '\\Foodsharing\\TranslationManager\\Controller@getInterfaceLocale');
    \Route::get('keyop/{group}/{op?}', '\\Foodsharing\\TranslationManager\\Controller@getKeyop');
    \Route::get('publish/{group}', '\\Foodsharing\\TranslationManager\\Controller@getPublish');
    \Route::get('search', '\\Foodsharing\\TranslationManager\\Controller@getSearch');
    \Route::get('toggle_in_place_edit', '\\Foodsharing\\TranslationManager\\Controller@getToggleInPlaceEdit');
    \Route::get('trans_filters', '\\Foodsharing\\TranslationManager\\Controller@getTransFilters');
    \Route::get('translation', '\\Foodsharing\\TranslationManager\\Controller@getTranslation');
    \Route::get('usage_info', '\\Foodsharing\\TranslationManager\\Controller@getUsageInfo');
    \Route::get('view', '\\Foodsharing\\TranslationManager\\Controller@getView');
    \Route::get('zipped_translations/{group?}', '\\Foodsharing\\TranslationManager\\Controller@getZippedTranslations');
    \Route::post('add/{group}', '\\Foodsharing\\TranslationManager\\Controller@postAdd');
    \Route::post('copy_keys/{group}', '\\Foodsharing\\TranslationManager\\Controller@postCopyKeys');
    \Route::post('delete/{group}/{key}', '\\Foodsharing\\TranslationManager\\Controller@postDelete');
    \Route::post('delete_all/{group}', '\\Foodsharing\\TranslationManager\\Controller@postDeleteAll');
    \Route::post('delete_keys/{group}', '\\Foodsharing\\TranslationManager\\Controller@postDeleteKeys');
    \Route::post('delete_suffixed_keys{group?}', '\\Foodsharing\\TranslationManager\\Controller@postDeleteSuffixedKeys');
    \Route::post('edit/{group}', '\\Foodsharing\\TranslationManager\\Controller@postEdit');
    \Route::post('find', '\\Foodsharing\\TranslationManager\\Controller@postFind');
    \Route::post('import/{group}', '\\Foodsharing\\TranslationManager\\Controller@postImport');
    \Route::post('move_keys/{group}', '\\Foodsharing\\TranslationManager\\Controller@postMoveKeys');
    \Route::post('preview_keys/{group}', '\\Foodsharing\\TranslationManager\\Controller@postPreviewKeys');
    \Route::post('publish/{group}', '\\Foodsharing\\TranslationManager\\Controller@postPublish');
    \Route::post('show_source/{group}/{key}', '\\Foodsharing\\TranslationManager\\Controller@postShowSource');
    \Route::post('undelete/{group}/{key}', '\\Foodsharing\\TranslationManager\\Controller@postUndelete');
    \Route::post('user_locales', '\\Foodsharing\\TranslationManager\\Controller@postUserLocales');
    \Route::post('yandex_key', '\\Foodsharing\\TranslationManager\\Controller@postYandexKey');
});
/*
\Route::group(['middleware' => 'web', 'prefix' => 'translation', 'as' => 'translation.', 'namespace' => 'Translation'], function () {
    \Route::get('index', 'Translation\\Foodsharing\\TranslationManager\\Controller@index')->name('index');
});
*/
