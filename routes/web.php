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


# ------------------小说路由处理------------------------


Route::get('/articles/{bid}/{slug?}/{any?}', 'NovelsController\ArticlesController@show')->name('web.articles.show');

Route::get('/content/{bid}/{cid}/{any?}', 'NovelsController\ArticlesController@showContent')->name('web.articles.content');
Route::get('/fenlei/{id}','NovelsController\ArticlesController@showfenlei')->name('web.articles.fenlei');
# ------------------ajax路由处理------------------------

Route::post('webajax/user/getuser', 'NovelsController\UsersController@getuser')->name('webajax.member.getuser');
Route::post('webajax/bookshelf/getbookshelfs', 'NovelsController\BookshelfsController@getBookshelfsData')->name('webajax.bookshelf.getbookshelfs');
Route::post('webajax/bookshelf/addbookcase', 'NovelsController\BookshelfsController@addbookcase')->name('webajax.bookshelf.addbookcase');
Route::post('webajax/user/recommend', 'NovelsController\UsersController@recommend')->name('webajax.user.recommend');
# ------------------用户------------------------
Route::group([
    'prefix'        => 'member',
    'namespace'     => 'NovelsController',
    'middleware'    => ['auth'],
], function () {


    //Route::get('bookshelf', 'NovelsController\UsersController@bookshelf')->name('web.bookshelf');
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

    Route::get('user', 'UsersController@show')->name('member.user.show');
    Route::post('user', 'UsersController@update');
    Route::get('user/edit', 'UsersController@edit')->name('member.user.edit');
    Route::get('user/passedit', 'UsersController@passedit')->name('member.user.passedit');
    Route::post('user/passedit', 'UsersController@passupdate');


    //附件上传地址
    Route::post('users/imageupload', 'UsersController@imageUpload')->name('member.user.imageupload');
    Route::post('users/updateavatar', 'UsersController@updateAvatar')->name('member.user.updateavatar');


    //Route::get('bookshelf', 'BookshelfsController@show')->name('member.bookshelf.show');
    Route::get('bookshelf', 'BookshelfsController@index')->name('member.bookshelf.index');
    Route::match(['get', 'post'] ,'bookshelf/{id?}', 'BookshelfsController@destroy')->name('member.bookshelf.destroy');
    Route::get('bookshelf/clickbookshelf/{bid?}/{cid?}', 'BookshelfsController@clickBookshelf')->name('member.bookshelf.clickbookshelf');

    //收件箱
    Route::get('inboxs', 'InboxsController@index')->name('member.inboxs.index');
    Route::get('inboxs/{id}', 'InboxsController@show')->name('member.inboxs.show');
    Route::delete('inboxs', 'InboxsController@destroy')->name('member.inboxs.destroy');
    //发件箱
    Route::get('outboxs', 'OutboxsController@index')->name('member.outboxs.index');
    Route::post('outboxs', 'OutboxsController@store')->name('member.outboxs.store');
    Route::get('outboxs/{id}', 'OutboxsController@show')->name('member.outboxs.show');
    Route::get('outboxs/create', 'OutboxsController@create')->name('member.outboxs.create');

    Route::delete('outboxs', 'OutboxsController@destroy')->name('member.outboxs.destroy');

    Route::get('qiandao', 'UserSignInController@show')->name('member.qiandao.show');
    Route::get('qiandao/update', 'UserSignInController@update')->name('member.qiandao.update');
});

Route::group([
    'prefix'        => 'web',
    'namespace'     => 'NovelsController',
    //'middleware'    => ['auth'],
], function () {

  Route::get('login', 'LoginController@create')->name('web.login.create');
  Route::post('login', 'LoginController@store');
  Route::any('logout', 'LoginController@destroy')->name('web.login.destroy');

  Route::get('register', 'RegisterController@create')->name('web.register.create');
  Route::post('register', 'RegisterController@store');


  Route::get('password','PasswordController@create')->name('web.password.create');
  Route::post('password','PasswordController@store')->name('password.store');



});
Route::get('storage/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}',function(){
    \App\Libraries\ImageRoute::imageStorageRoute();
});
