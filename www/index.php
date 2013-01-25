<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;


$app->get('/{uri}', function ($uri) use ($app) {
    
    $uri_mix  = explode('?', $uri);
    $uri_path = $uri_mix[0];
    $uri_mix  = explode('/', $uri_path);
    
    $controller_name = (isset($uri_mix[0]) AND !empty($uri_mix[0])) ? $uri_mix[0] : 'index';
    $controller_name = "App\\Controller\\" . ucfirst( strtolower($controller_name) );
    $controller      = new $controller_name;
    
    $action_name = (isset($uri_mix[1]) AND !empty($uri_mix[1])) ? $uri_mix[1] : 'index';
    $action_name = 'action_' . strtolower($action_name);
    
    $output = $controller->$action_name;
    
    var_dump($output);
    
    return '<hr/>';    
    
})->assert('uri', '.+')->value('uri', 'index/');

/*
'App\Controller\Photo::openAction'

$app->get('/{uri}', function ($uri) use ($app) {
    return $uri;
})->assert('uri', '.+')->value('uri', 'index/');

*/

$app->run();
