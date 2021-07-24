<?php

namespace App\Providers;

use App\Repository\BaseRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\CategoryRepository;
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
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
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
