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





    $router->get('users', 'UsersController@index')->name('admin-users.index');
    $router->get('users/{id}/edit', 'UsersController@edit')->name('admin-users.edit');

    $router->resource('articles', ArticlesController::class);
    //$router->resource('admin/inboxs', InboxsController::class);


    //$router->get('inboxs', 'InboxsController@index')->name('admin-inboxs.index');
    //$router->get('inboxs/{id}', 'InboxsController@show')->name('admin-inboxs.show');
    //$router->post('inboxs/reply', 'InboxsController@reply')->name('admin-inboxs.reply');
    //$router->post('inboxs/imageupload', 'InboxsController@imageUpload')->name('admin-inboxs.imageupload');
    //$router->any('laji/articles/laji', 'ArticlesController@test');
    /*
    get('/users', 'UsersController@index')->name('users.index');
    get('/users/{id}', 'UsersController@show')->name('users.show');
    get('/users/create', 'UsersController@create')->name('users.create');//注册地址
    post('/users', 'UsersController@store')->name('users.store');//注册提交地址
    get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
    patch('/users/{id}', 'UsersController@update')->name('users.update');
    delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');
     */
     //$router->resource('articles', ArticlesController::class);
     $router->resource('chapters', ChaptersController::class);

     $router->resource('honors', HonorsController::class);


     $router->delete('delhonorscache', 'HonorsController@delCache')->name('admin.delhonorscache');



     $router->get('outboxs', 'OutboxsController@index')->name('admin-outboxs.index');
     $router->get('outboxs/{id}', 'OutboxsController@show')->name('admin-outboxs.show');


     $router->resource('adminresource/sorts', 'SortsController', ['except' => ['create']]);

     /*
     $router->get('sorts', 'SortsController@index')->name('admin-sorts.index');
     $router->post('sorts', 'SortsController@store')->name('admin-sorts.store');
     $router->get('sorts/{id}/edit', 'SortsController@edit')->name('admin-sorts.edit');
     //$router->get('sorts/{id}', 'UsersController@show')->name('admin-sorts.show');
     $router->post('sorts/{id}', 'SortsController@update')->name('admin-sorts.update');
     $router->delete('sorts/{id}', 'SortsController@destroy')->name('admin-sorts.destroy');
     */



     $router->get('trashes', 'TrashesController@index')->name('admin-trashes.index');


});
