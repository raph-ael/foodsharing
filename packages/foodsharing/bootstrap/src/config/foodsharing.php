<?php
/**
 * Foodsharing specific Configurration
 */

return [
    'mem_enabled' => false,
    'sock_url' => 'http://chat:1338/',
    'redis_host' => 'redis',

    'meta' => [
        'description' => 'Auf foodsharing.de kannst Du Deine Lebensmittel vor dem Verfall an soziale Einrichtungen oder andere Personen abgeben',
        'keywords' => 'foodsharing, essen, lebensmittel, ablaufdatum, Lebensmittelverschwendung, essen wegschmeissen, spenden, lebensmitteltausch',
        'author' => 'foodsharing',
        'robots' => 'all',
        'allow-search' => 'yes',
        'revisit-after' => '1 days',
        'google-site-verification' => 'pZxwmxz2YMVLCW0aGaS5gFsCJRh-fivMv1afrDYFrks'
    ],
    'head' => '',
    'title' => ['foodsharing'],
    'css' => [],
    'css_inline' => '',
    'script' => []
];