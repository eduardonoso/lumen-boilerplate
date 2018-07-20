<?php
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

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'account'], function () use ($router) {
        $router->get('/', 'UserController@get');
        $router->post('/', 'UserController@post');
    });
    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->get('/', 'ProductController@get');
    });
});