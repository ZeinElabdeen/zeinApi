<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\PriceType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

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
        config(['category_storage' => $uploads.'/category/']);
        config(['item_storage' => $uploads.'/ad/']);
        config(['plan_storage' => $uploads.'/plan/']);
        config(['attaches_storage' => $uploads.'/attaches/']);

        View::composer('*',function ($view) {
            $categories = Category::categories();
//            $sizes = Size::sizes();
//            $view->with('categories',$categories)
//                ->with('sizes',$sizes);
        });
    }
}
