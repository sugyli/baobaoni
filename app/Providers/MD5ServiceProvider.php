<?php

namespace App\Providers;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
class MD5ServiceProvider extends EloquentUserProvider
{

    //继承EloquentUserProvider类，调用父类的构造函数
    public function __construct($hasher, $model)
    {
        parent::__construct($hasher, $model);
    }


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
