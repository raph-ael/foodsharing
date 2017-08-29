<?php
    include 'functions.php';
Route::group(['prefix' => 'install', 'as' => 'Installer::', 'namespace' => 'Foodsharing\Installer\Controllers', 'middleware' => ['install']], function()
{
    /*
     * Default Language German
     */

    Route::get('/', [
            'as' => 'welcome',
            'uses' => 'WelcomeController@welcome'
        ]);

        Route::get('environment', [
            'as' => 'environment',
            'uses' => 'EnvironmentController@environment'
        ]);

        Route::get('environment/save', [
            'as' => 'environmentSave',
            'uses' => 'EnvironmentController@save'
        ]);

        Route::get('requirements', [
            'as' => 'requirements',
            'uses' => 'RequirementsController@requirements'
        ]);

        Route::get('permissions', [
            'as' => 'permissions',
            'uses' => 'PermissionsController@permissions'
        ]);

        Route::get('database', [
            'as' => 'database',
            'uses' => 'DatabaseController@database'
        ]);

        Route::get('dummydata', [
            'as' => 'dummydata',
            'uses' => 'DummydataController@dummydata'
        ]);

        Route::get('final', [
            'as' => 'final',
            'uses' => 'FinalController@finish'
        ]);

        Route::get('finaldummy', [
            'as' => 'finaldummy',
            'uses' => 'FinalController@finishdummy'
        ]);

});
