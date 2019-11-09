<?php

namespace App\Providers;

use App\Property;
use Illuminate\Auth\Access\Response;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Users can't book their own properties
         */
        Gate::define('book-property', function ($user, $propertyId) {
            $property = Property::find($propertyId);
            return $user->id !== $property->user_id ? Response::allow()
                : Response::deny('You cannot book your own property.');
        });


        Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
