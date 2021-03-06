<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web1', 'admin'],
    'domain' => config('app.url_admin')
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('honors', HonorsController::class);
    $router->delete('delhonorscache', 'HonorsController@delCache')->name('admin.delhonorscache');

    $router->resource('inboxs', InboxsController::class, ['except' => ['create','edit','destroy','update']]);
    $router->post('inboxs/imageupload', 'InboxsController@imageUpload');

    $router->resource('outboxs', OutboxsController::class, ['except' => ['create','store','edit','destroy','update']]);
    $router->get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


    //$router->get('systemsettings', 'SystemSettingsController@index');
    //$router->post('systemsettings', 'SystemSettingsController@seting');

    //$router->resource('sorts', 'SortsController', ['except' => ['create']]);



    //$router->resource('outboxs', OutboxsController::class, ['except' => ['create','store','edit','destroy','update']]);
    //$router->resource('articles', ArticlesController::class);
    //$router->resource('honors', HonorsController::class);
    //$router->delete('delhonorscache', 'HonorsController@delCache')->name('admin.delhonorscache');

    /*
    get('/users', 'UsersController@index')->name('users.index');
    get('/users/{id}', 'UsersController@show')->name('users.show');
    get('/users/create', 'UsersController@create')->name('users.create');//注册地址
    post('/users', 'UsersController@store')->name('users.store');//注册提交地址
    get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
    patch('/users/{id}', 'UsersController@update')->name('users.update');
    delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');
     */
     //$router->get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


});
