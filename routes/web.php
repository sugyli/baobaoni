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



Route::get('/', 'PagesController@home')->middleware('lasthead');

Route::group([
    'namespace'     => 'MNovels',
    'middleware'    => ['lasthead'],
], function () {
    Route::get('/info-{bid}/{any?}', 'NovelsController@info')->name('mnovels.info');

    Route::get('/wapbook-{bid}-{cid}/{any?}', 'NovelsController@content')->name('mnovels.content');

    Route::get('/hislogs', 'NovelsController@hislogs')->name('mnovels.hislogs');

    Route::get('/wapbook-{bid}_{zid}/{any?}', 'RouteCacheJController@cache1');
    Route::get('/wapbook-{bid}_{zid}_{id}/{any?}', 'RouteCacheJController@cache1');
    Route::get('/mulu/{bid}','NovelsController@mulu')->name('mnovels.mulu');


    Route::get('/wapsort', 'NovelsController@wapsort')->name('mnovels.wapsort');
    Route::get('/wapsort/{id}', 'NovelsController@showwapsort')->name('mnovels.showwapsort');

    Route::get('/waptop', 'NovelsController@waptop')->name('mnovels.waptop');
    Route::get('/waptop/{any}', 'NovelsController@showwaptop')->name('mnovels.showwaptop');

    Route::get('/search', 'NovelsController@search');

});



Route::group([
    'namespace'     => 'MNovels',
    'prefix'        => 'user',
    'middleware'    => ['web'],
], function () {

    Route::get('/login', 'LoginController@create')->name('mnovels.login');
    Route::post('/login', 'LoginController@store');
    Route::any('/logout', 'LoginController@destroy')->name('mnovels.login.destroy');

    Route::get('/register', 'RegisterController@create')->name('mnovels.register');
    Route::post('/register', 'RegisterController@store');


    Route::get('/clickbookshelf/{bid?}/{cid?}', 'BookshelfsController@clickBookshelf')->name('mnovels.clickbookshelf');
});

Route::group([
    'namespace'     => 'MNovels',
    'prefix'        => 'user',
    'middleware'    => ['web','auth'],
], function () {

    Route::get('/show', 'UsersController@show')->name('mnovels.user.show');
    Route::get('/passedit', 'UsersController@passedit')->name('mnovels.user.passedit');
    Route::post('/passedit', 'UsersController@passupdate');



    Route::get('/bookshelf', 'BookshelfsController@index')->name('mnovels.bookshelf.index');

    Route::get('/inboxs', 'InboxsController@index')->name('mnovels.inboxs.index');
    Route::get('inboxs/{id}', 'InboxsController@show')->name('mnovels.inboxs.show');
    Route::get('/inboxs/destroy/{id}', 'InboxsController@destroy')->name('mnovels.inboxs.destroy');

    Route::get('/outboxs', 'OutboxsController@index')->name('mnovels.outboxs.index');
    Route::get('/outboxs/{id}', 'OutboxsController@show')->name('mnovels.outboxs.show');
    Route::get('/outboxs/destroy/{id}', 'OutboxsController@destroy')->name('mnovels.outboxs.destroy');
});




Route::group([
    'prefix'        => 'ajax',
    'namespace'     => 'MNovels',
    'middleware'    => ['web'],
], function () {

    Route::post('/recommend', 'UsersController@recommend')->name('ajax.recommend');
    Route::post('/addbookcase', 'BookshelfsController@addbookcase')->name('ajax.addbookcase');
    Route::post('/search', 'NovelsController@getsearch')->name('ajax.search');
    Route::post('/mulu','NovelsController@getmulu')->name('ajax.mulu');
    Route::post('/sendmessage', 'OutboxsController@ajaxstore')->name('ajax.sendmessage');
    Route::post('/getbookshelfs', 'BookshelfsController@getBookshelfsData')->name('ajax.getbookshelfs');

    Route::post('/bookshelf/destroy', 'BookshelfsController@destroy')->name('ajax.destroy');
});

//Route::get('/info/{bid}/{slug?}/{any?}', 'NovelsController@info')->name('novel.info');


//Route::get('/content/{bid}/{cid}/{any?}', 'NovelsController@content')->name('novel.content');






Route::get('storage/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}','\App\Libraries\ImageRoute@imageStorageRoute');
