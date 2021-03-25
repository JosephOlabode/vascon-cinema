<?php

namespace App\Providers;

use App\Repository\CinemaRepository;
use App\Repository\ICinema;
use Illuminate\Support\ServiceProvider;

class CinemaRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICinema::class, CinemaRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
