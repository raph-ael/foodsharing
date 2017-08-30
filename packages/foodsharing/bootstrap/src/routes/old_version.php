<?php


$bootstrap = '\Foodsharing\Bootstrap\Http\Controllers\BootstrapController';


/*
 * routes to get old stuff run
 */
Route::middleware(['web'])->group(function () use($bootstrap){

    Route::any('/', $bootstrap . '@bootIndex');

    Route::any('/xhrapp', $bootstrap . '@bootXhrapp');

    Route::any('/xhr', $bootstrap . '@bootXhr');

    Route::any('/uploadphp', $bootstrap . '@uploadphp');

    Route::any('/partner', $bootstrap . '@partner');

    Route::any('/groups', $bootstrap . '@groups');

    Route::any('/ueber-uns', $bootstrap . '@ueberUns');

    Route::any('/team', $bootstrap . '@team');

    Route::any('/faq', $bootstrap . '@faq');

    Route::any('/fuer-unternehmen', $bootstrap . '@fuerUnternehmen');

    Route::any('/leeretonne', $bootstrap . '@leeretonne');

    Route::any('/fairteilerrettung', $bootstrap . '@fairteilerrettung');

    Route::any('/unterstuetzung', $bootstrap . '@unterstuetzung');

    Route::any('/impressum', $bootstrap . '@impressum');

    Route::any('/ratgeber', $bootstrap . '@ratgeber');

    Route::any('/recovery', $bootstrap . '@recovery');

    //Route::get('/login', $bootstrap . '@login');

    Route::any('/login', $bootstrap . '@login');

    Route::any('/karte', $bootstrap . '@karte');

    Route::any('/dashboard', $bootstrap . '@dashboard');

    Route::any('/news', $bootstrap . '@news');

    Route::any('/mach-mit', $bootstrap . '@machMit');

    Route::any('/messages', $bootstrap . '@messages');

    Route::any('/fairteiler', $bootstrap . '@fairteiler');

    Route::any('/statistik', $bootstrap . '@statistik');

    Route::any('/event', $bootstrap . '@event');

    Route::any('/event-en', $bootstrap . '@eventEn');

    Route::any('/wuppdays', $bootstrap . '@wuppdays');

    Route::get('/empty.html', $bootstrap . '@emptyPage');

    Route::any('/essenskoerbe/{id?}', $bootstrap . '@essenskorb');

    Route::any('/blog/{id}', $bootstrap . '@blog');

    Route::any('/profile/{id}', $bootstrap . '@profile');
});




