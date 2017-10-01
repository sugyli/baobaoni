<?php

# ------------------小说介绍路由处理------------------------
Route::get('/jieshaoinfo/{id}/{bid}.htm', function ($id, $bid) {
    $bakUrl = route('bookinfos.show', ['article' => $bid]);
    return redirect($bakUrl, 301);
});
Route::get('/book/{id}/{bid}/index.html', function ($id, $bid) {
    $bakUrl = route('bookinfos.show', ['article' => $bid]);
    return redirect($bakUrl, 301);
});

Route::get('/book/{id}/{bid}', function ($id, $bid) {

    $bakUrl = route('bookinfos.show', ['article' => $bid]);
    return redirect($bakUrl, 301);
});

# ------------------小说内容路由处理------------------------
Route::get('/book/{id}/{bid}/{cid}.html', function ($id , $bid, $cid) {

    $bakUrl = route('contents.showContent', ['article' => $bid ,'cid' => $cid]);
    return redirect($bakUrl, 301);
});







 ?>
