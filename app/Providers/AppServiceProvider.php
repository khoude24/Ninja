<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\External\ExternalClientRepositoryInterface',
            'App\Repositories\External\ExternalClientRepository'
        );

        $this->app->bind(
            'App\Repositories\Words\WordRepositoryInterface',
            'App\Repositories\Words\WordRepository'
        );
    }
}
