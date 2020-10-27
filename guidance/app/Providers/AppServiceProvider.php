<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        $uploads = asset('uploads');
        config(['user_storage' => $uploads.'/user/']);
        config(['driver_storage' => $uploads.'/driver/']);
        config(['attaches_storage' => $uploads.'/attaches/']);
        config(['ad_storage' => $uploads.'/ad/']);
        config(['image_storage' => $uploads.'/attaches/messages/image']);
        config(['voice_storage' => $uploads.'/attaches/messages/voice']);
    }
}
