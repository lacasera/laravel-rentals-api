<?php

namespace App\Providers;

use App\Services\CDN\CdnInterface;
use App\Services\Cloudinary\CloudinaryService;
use Illuminate\Support\ServiceProvider;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CdnInterface::class, CloudinaryService::class);

        $this->app->when(CloudinaryService::class)
            ->needs('$apiKey')
            ->give(config('cdn.cloudinary.apiKey'));

        $this->app->when(CloudinaryService::class)
            ->needs('$apiSecret')
            ->give(config('cdn.cloudinary.apiSecret'));

        $this->app->when(CloudinaryService::class)
            ->needs('$cloudName')
            ->give(config('cdn.cloudinary.cloudName'));
    }

}
