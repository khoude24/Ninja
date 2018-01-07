<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\External\ExternalClientRepository;
use App\Repositories\Words\CachingWordRepository;
use App\Repositories\Words\WordRepository;
use App\Repositories\Words\WordRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WordRepositoryInterface::class, function () {
            $wordRepository = new WordRepository(new ExternalClientRepository(), new AuthRepository());

            return  new CachingWordRepository(
                $wordRepository,
                $this->app['cache.store']
            );
        });
    }
}