<?php

namespace App\Providers;

use App\Repository\IMovies;
use App\Repository\MoviesRepository;
use Illuminate\Support\ServiceProvider;

class MoviesRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IMovies::class, MoviesRepository::class);
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
