<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(30));

        Passport::refreshTokensExpireIn(now()->addMonths(3));

        Passport::personalAccessTokensExpireIn(now()->addYears(2));

        Passport::tokensCan([
            'read' => 'This Application will be abe to Read Records',
            'insert' => 'This Application will be abe to Insert Records',
            'update' => 'This Application will be abe to Update Records',
            'delete' => 'This Application will be abe to Delete records',
        ]);
//        Passport::$ignoreCsrfToken = true;
    }
}
