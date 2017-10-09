<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');

        //运行的 MySQL 版本低于 5.7.7
        Schema::defaultStringLength(191);
        \Validator::extend('zh_mobile', function ($attribute, $value) {
            return preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[3678]|18\d)\d{8}|170[059]\d{7})$/', $value);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
