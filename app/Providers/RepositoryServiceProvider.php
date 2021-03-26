<?php

namespace App\Providers;

use App\Repository\RepositoryClasses\CinemaRepository;
use App\Repository\RepositoryClasses\MoviesRepository;
use App\Repository\RepositoryClasses\ShowTimeRepository;
use App\Repository\RepositoryClasses\UserRepository;
use App\Repository\RepositoryInterfaces\ICinema;
use App\Repository\RepositoryInterfaces\IMovies;
use App\Repository\RepositoryInterfaces\IShowtime;
use App\Repository\RepositoryInterfaces\IUser;
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
