<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class MacrosServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('cloudinaryIds', function () {
            return $this->map(function ($image) {
                return explode('/', $image->public_id)[1];
            });
        });

    }
}
