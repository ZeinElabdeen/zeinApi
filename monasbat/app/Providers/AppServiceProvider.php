<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $uploads = asset('uploads');
        config(['user_storage' => $uploads.'/user/']);
        config(['attach_storage' => $uploads.'/attaches/']);
        config(['category_storage' => $uploads.'/category/']);
        config(['ad_storage' => $uploads.'/ad/']);
    }
}
