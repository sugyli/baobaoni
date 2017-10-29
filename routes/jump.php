<?php


Route::group([
    'namespace'     => 'NovelsController',
], function () {
    Route::get('/jieshaoinfo/{zid}/{bid}.htm', 'RouteCacheJController@cache1');
    Route::get('/book/{zid}/{bid}/index.html', 'RouteCacheJController@cache1');
    Route::get('/book/{zid}/{bid}', 'RouteCacheJController@cache1');


    Route::get('/info-{bid}/{any?}', 'RouteCacheJController@cache1');
    Route::get('/wapbook-{bid}/{any?}', 'RouteCacheJController@cache1');
    Route::get('/wapbook-{bid}_{zid}/{any?}', 'RouteCacheJController@cache1');
    Route::get('/wapbook-{bid}_{zid}_{id}/{any?}', 'RouteCacheJController@cache1');



    Route::get('/sort-{id}-{zid}/{any?}', 'RouteCacheJController@cache2');
    Route::get('/fenlei/sort{id}/{zid}/{n}.htm', 'RouteCacheJController@cache2');



    Route::get('/book/{zid}/{bid}/{cid}.html', 'RouteCacheJController@cache3');

    Route::get('/wapbook-{bid}-{cid}/{any?}', 'RouteCacheJController@cache3');
});
/*
# ------------------小说介绍路由处理------------------------
Route::get('/jieshaoinfo/{zid}/{bid}.htm', function ($zid, $bid) {
    $bakUrl = route('web.articles.show', ['bid' => $bid]);
    return redirect($bakUrl, 301);
});

Route::get('/book/{zid}/{bid}/index.html', function ($zid, $bid) {
    $bakUrl = route('web.articles.show', ['bid' => $bid]);
    return redirect($bakUrl, 301);
});

Route::get('/book/{zid}/{bid}', function ($zid, $bid) {

    $bakUrl = route('web.articles.show', ['bid' => $bid]);
    return redirect($bakUrl, 301);
});

Route::get('/sort-{id}-{zid}/{any?}', function ($id) {

    $bakUrl = route('web.articles.fenlei', ['id' => $id]);
    return redirect($bakUrl, 301);
});
Route::get('/fenlei/sort{id}/{zid}/{n}.htm', function ($id) {

    $bakUrl = route('web.articles.fenlei', ['id' => $id]);
    return redirect($bakUrl, 301);
});

# ------------------小说内容路由处理------------------------
Route::get('/book/{zid}/{bid}/{cid}.html', function ($zid , $bid, $cid) {

    $bakUrl = route('web.articles.content', ['bid' => $bid ,'cid' => $cid]);
    return redirect($bakUrl, 301);
});


# ------------------WAP路由处理------------------------

Route::get('/info-{bid}/{any?}', function ($bid) {

    $bakUrl = route('web.articles.show', ['bid' => $bid]);
    return redirect($bakUrl, 301);
});

Route::get('/wapbook-{bid}/{any?}', function ($bid) {

    $bakUrl = route('web.articles.show', ['bid' => $bid]);
    return redirect($bakUrl, 301);
});

Route::get('/wapbook-{bid}_{zid}/{any?}', function ($bid ,$zid) {

    $bakUrl = route('web.articles.show', ['bid' => $bid]);
    return redirect($bakUrl, 301);
});

Route::get('/wapbook-{bid}_{zid}_{id}/{any?}', function ($bid) {

    $bakUrl = route('web.articles.show', ['bid' => $bid]);
    return redirect($bakUrl, 301);
});


Route::get('/wapbook-{bid}-{cid}/{any?}', function ($bid ,$cid) {

    $bakUrl = route('web.articles.content', ['bid' => $bid ,'cid' => $cid]);
    return redirect($bakUrl, 301);
});

*/

?>
