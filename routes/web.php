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
Route::get('/', 'PagesController@home')->name('home');

include_once('jump.php');
include_once('admin.php');


# ------------------小说介绍路由处理------------------------


Route::get('/articles/{bid}/{slug?}/{any?}', 'NovelsController\ArticlesController@show')->name('articles.show');

Route::get('/content/{bid}/{cid}/{any?}', 'NovelsController\ArticlesController@showContent')->name('articles.content');
# ------------------小说内容路由处理------------------------



//Route::get('/contents/{article}/{cid}', 'NovelsController\ArticlesController@showContent')->name('contents.showContent');

Route::post('ajax/user/getuser', 'NovelsController\UsersController@getuser')->name('ajax.member.getuser');
Route::post('ajax/bookshelf/getbookshelfs', 'NovelsController\BookshelfsController@getBookshelfsData')->name('ajax.bookshelf.ajaxbookshelf');
Route::post('ajax/bookshelf/addbookcase', 'NovelsController\BookshelfsController@addbookcase')->name('ajax.bookshelf.addbookcase');
Route::post('ajax/user/recommend', 'NovelsController\UsersController@recommend')->name('ajax.member.recommend');
# ------------------用户------------------------
Route::group([
    'prefix'        => 'member',
    'namespace'     => 'NovelsController',
    'middleware'    => ['auth'],
], function () {




    Route::get('bookshelf', 'NovelsController\UsersController@bookshelf')->name('web.bookshelf');
    //Route::match(['get', 'post'] , 'delbookshelf/{id?}', 'NovelsController\UsersController@delBookshelf')->name('web.delbookshelf');



    //Route::get('clickbookshelf/{bid}/{cid?}', 'NovelsController\UsersController@clickBookshelf')->name('web.clickbookshelf');


    /*
    get('/users', 'UsersController@index')->name('users.index');
    get('/users/{id}', 'UsersController@show')->name('users.show');
    get('/users/create', 'UsersController@create')->name('users.create');//注册地址
    post('/users', 'UsersController@store')->name('users.store');//注册提交地址
    get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
    patch('/users/{id}', 'UsersController@update')->name('users.update');
    delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');
     */

  //  Route::resource('inboxs', InboxsController::class);

    Route::get('user', 'UsersController@show')->name('member.show');

    Route::get('user/edit', 'UsersController@edit')->name('member.edit');
    Route::post('user', 'UsersController@update')->name('member.update');
    Route::get('user/passedit', 'UsersController@passedit')->name('member.passedit');
    Route::post('user/passedit', 'UsersController@passupdate');


    //附件上传地址
    Route::post('users/imageupload', 'UsersController@imageUpload')->name('member.imageupload');
    Route::post('users/updateavatar', 'UsersController@updateAvatar')->name('member.updateavatar');


    Route::get('bookshelf', 'BookshelfsController@show')->name('bookshelf.show');

    Route::match(['get', 'post'] ,'bookshelf/{id?}', 'BookshelfsController@destroy')->name('bookshelf.destroy');
    Route::get('bookshelf/clickbookshelf/{bid?}/{cid?}', 'BookshelfsController@clickBookshelf')->name('bookshelf.clickbookshelf');

    //收件箱
    Route::get('inboxs', 'InboxsController@index')->name('inboxs.index');
    Route::get('inboxs/{id}', 'InboxsController@show')->name('inboxs.show');
    Route::delete('inboxs/{id?}', 'InboxsController@destroy')->name('inboxs.destroy');
    //发件箱
    Route::get('outboxs', 'OutboxsController@index')->name('outboxs.index');
    Route::get('outboxs/{id}', 'OutboxsController@show')->name('outboxs.show');
    Route::get('outboxs/create', 'OutboxsController@create')->name('outboxs.create');
    Route::post('outboxs', 'OutboxsController@store')->name('outboxs.store');
    Route::delete('outboxs/{id?}', 'OutboxsController@destroy')->name('outboxs.destroy');

    Route::get('qiandao', 'UserSignInController@show')->name('qiandao.show');
    Route::get('qiandao/update', 'UserSignInController@update')->name('qiandao.update');
});

Route::group([
    'prefix'        => 'web',
    'namespace'     => 'NovelsController',
    //'middleware'    => ['auth'],
], function () {

  Route::get('login', 'LoginController@create')->name('login.create');
  Route::post('login', 'LoginController@store')->name('login.store');
  Route::any('logout', 'LoginController@destroy')->name('login.destroy');

  Route::get('register', 'RegisterController@create')->name('register.create');
  Route::post('register', 'RegisterController@store')->name('register.store');


  Route::get('password','PasswordController@create')->name('password.create');
  Route::post('password','PasswordController@store')->name('password.store');

});
Route::get('storage/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}',function(){
    \App\Libraries\ImageRoute::imageStorageRoute();
});
