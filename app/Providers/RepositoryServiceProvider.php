<?php

namespace App\Providers;

use App\Repository\BaseRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\PlayerRepository;
use App\Repository\PlayerRepositoryInterface;
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
        $this->app->bind(BaseRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class,PlayerRepository::class);
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
