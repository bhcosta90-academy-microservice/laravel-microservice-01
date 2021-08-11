<?php

namespace App\Providers;

use App\Http\Middleware\JsonResponseMiddleware;
use App\Models\Category;
use App\Observers\SlugObserver;
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
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('api', JsonResponseMiddleware::class);
        app('router')->aliasMiddleware('json', JsonResponseMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(SlugObserver::class);
    }
}
