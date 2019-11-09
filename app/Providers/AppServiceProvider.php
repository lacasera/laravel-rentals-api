<?php

namespace App\Providers;

use App\Property;
use App\Observers\PropertyObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Property::observe(PropertyObserver::class);
    }
}
