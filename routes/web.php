<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
# ------------------ Page Route ------------------------



Route::get('/', 'NovelsController@home');

Route::get('/info/{bid}/{slug?}/{any?}', 'NovelsController@info')->name('novel.info');
Route::get('/mulu/{bid}','NovelsController@mulu')->name('novel.mulu');
Route::get('/content/{bid}/{cid}/{any?}', 'NovelsController@content')->name('novel.content');




Route::group([
    'prefix'        => 'ajax',
    //'namespace'     => 'NovelsController',
    //'middleware'    => ['novel'],
], function () {

  Route::post('/getmulu','NovelsController@ajaxmulu')->name('novel.ajaxmulu');
  Route::post('/user/recommend', 'UsersController@recommend')->name('novel.ajaxrecommend');
  Route::post('/user/addbookcase', 'BookshelfsController@addbookcase')->name('novel.ajaxaddbookcase');
  Route::post('/outboxs/store', 'OutboxsController@ajaxstore')->name('novel.outboxs.ajaxstore');
  Route::get('/bookshelf/clickbookshelf/{bid?}/{cid?}', 'BookshelfsController@clickBookshelf')->name('novel.bookshelf.clickbookshelf');

  Route::post('/bookshelf/getbookshelfs', 'BookshelfsController@getBookshelfsData')->name('novel.bookshelf.getbookshelfs');
  Route::post('/bookshelf/destroy', 'BookshelfsController@destroy')->name('novel.bookshelf.destroy');



});

Route::get('/user/login', 'LoginController@create')->name('novel.login');
Route::post('/user/login', 'LoginController@store');
Route::any('/user/logout', 'LoginController@destroy')->name('novel.login.destroy');



Route::get('/user/register', 'RegisterController@create')->name('novel.register');
Route::post('/user/register', 'RegisterController@store');

Route::get('/user/password','PasswordController@create')->name('novel.password');

Route::group([
    'prefix'        => 'user',
    'middleware'    => ['auth'],
], function () {
    Route::get('/usershow', 'UsersController@show')->name('novel.user.show');
    Route::post('/usershow', 'UsersController@update');
    Route::get('/edit', 'UsersController@edit')->name('novel.user.edit');

    Route::get('/user/passedit', 'UsersController@passedit')->name('novel.user.passedit');
    Route::post('/user/passedit', 'UsersController@passupdate');


    Route::get('/outboxs', 'OutboxsController@index')->name('novel.outboxs.index');
    Route::get('/outboxs/create', 'OutboxsController@create')->name('novel.outboxs.create');
    Route::get('/outboxs/{id}', 'OutboxsController@show')->name('novel.outboxs.show');
    Route::get('/outboxs/destroy/{id}', 'OutboxsController@destroy')->name('novel.outboxs.destroy');
    //Route::post('/outboxs/store', 'OutboxsController@store')->name('novel.outboxs.webstore');

    Route::get('/inboxs', 'InboxsController@index')->name('novel.inboxs.index');
    Route::get('inboxs/{id}', 'InboxsController@show')->name('novel.inboxs.show');
    Route::get('/inboxs/destroy/{id}', 'InboxsController@destroy')->name('novel.inboxs.destroy');

    Route::get('/bookshelf', 'BookshelfsController@index')->name('novel.bookshelf.index');


});




Route::get('storage/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}','\App\Libraries\ImageRoute@imageStorageRoute');
