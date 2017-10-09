<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('systemsettings', 'SystemSettingsController@index');
    $router->post('systemsettings', 'SystemSettingsController@seting');

    $router->resource('sorts', 'SortsController', ['except' => ['create']]);

});
