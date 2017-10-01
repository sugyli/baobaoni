<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//auth:api 添加 auth 中间件到路由后，还需要指定使用哪个 guard 来实现认证。指定的 guard 对应配置文件 auth.php 中 guards 数组的某个键：
Route::middleware('auth:web')->get('/user', function (Request $request) {
    //返回认证过的用户的实例...
    return $request->user();
});
