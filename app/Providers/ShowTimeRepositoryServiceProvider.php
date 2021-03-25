<?php

namespace App\Providers;

use App\Repository\IShowtime;
use App\Repository\ShowTimeRepository;
use Illuminate\Support\ServiceProvider;

class ShowTimeRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IShowtime::class, ShowTimeRepository::class);
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
