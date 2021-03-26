<?php

namespace App\Providers;

use App\Repository\CinemaRepository;
use App\Repository\ICinema;
use App\Repository\IMovies;
use App\Repository\IShowtime;
use App\Repository\IUser;
use App\Repository\MoviesRepository;
use App\Repository\ShowTimeRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUser::class, UserRepository::class);
        $this->app->bind(IShowtime::class, ShowTimeRepository::class);
        $this->app->bind(ICinema::class, CinemaRepository::class);
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
