<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\TagComposer;
use App\Http\ViewComposers\UserComposer;
use App\Http\ViewComposers\HotPostComposer;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // URL::forceScheme('https');
        Schema::defaultStringLength(191);

        view()->composer('front/menu', MenuComposer::class);
        view()->composer('front/partials/home-right', TagComposer::class);
        view()->composer('front/partials/add-question', TagComposer::class);
        view()->composer('front/partials/home-right', UserComposer::class);
        view()->composer('back/home', UserComposer::class);
        view()->composer('front/partials/hot-post', HotPostComposer::class);
        view()->composer('back/home', HotPostComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}
