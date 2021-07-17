<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/v1/orders/{order_id}', 'OrderController@show');
$router->post('/v1/orders/{order_id}/prep_stage', 'OrderController@updateStage');
$router->post('/v1/orders/{order_id}/sync_status', 'OrderController@updateStatus');
