<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\V1\Controllers'], function ($api) {
        $api->post('auth/register', 'AuthenticationController@register');
        $api->post('auth/login', 'AuthenticationController@login');


        /*
        * todos routes
        */
        $api->get('todos/{id?}', 'TodoController@index');
        $api->post('todos', 'TodoController@store');



        /*
         * start of the protected routes
         *
         */
        $api->group(['middleware' => 'jwt.auth'], function ($api) {
        	$api->get('getcurrentuser', 'AuthenticationController@getCurrentUser');
        });

    });
});
