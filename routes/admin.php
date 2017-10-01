<?php


Route::group(['prefix' => '/nocache/admin'], function () {
    Route::get('users', function ()    {
      dd('ff');
    });
});

 ?>
