<?php

namespace App\Providers;

use App\Http\Middleware\JsonResponseMiddleware;
use App\Models\Category;
use App\Models\Company;
use App\Observers\SlugObserver;
use App\Observers\UuidObserver;
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
        Category::observe([SlugObserver::class, UuidObserver::class]);
        Company::observe([SlugObserver::class, UuidObserver::class]);
    }
}
