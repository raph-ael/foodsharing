<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'requirements' => [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer'
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage'           => '775',
        'bootstrap/cache/'       => '775',
        'public/tmp/'            => '775',
        'public/images/'         => '775',
        'public/images/basket'          => '775',
        'public/data/mailattach'        => '775',
        'public/data/attach'            => '775',
        'public/data/lostmessage'       => '775',
        'public/data/mailattach/tmp'    => '775',
        'public/data/pass'              => '775',
        'public/data/visite'            => '775',
        'public/cache/searchindex'      => '775',
        'resources/lang'      => '775',
        'packages/foodsharing/platform/src/lang'      => '775',

    ]
];
