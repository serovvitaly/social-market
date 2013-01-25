<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;


$app->get('/{uri}', 'App\Controller\Photo::openAction')->assert('uri', '.+')->value('uri', 'index/');

/*
$app->get('/{uri}', function ($uri) use ($app) {
    return $uri;
})->assert('uri', '.+')->value('uri', 'index/');

*/

$app->run();
