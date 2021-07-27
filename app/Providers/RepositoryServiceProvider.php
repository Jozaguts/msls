<?php

namespace App\Providers;

use App\Repository\BaseRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\PenaltyGoalKeeperRepository;
use App\Repository\Eloquent\PenaltyRepository;
use App\Repository\Eloquent\PlayerRepository;
use App\Repository\Eloquent\RefereeRepository;
use App\Repository\Eloquent\TeamRepository;
use App\Repository\PenaltyGoalKeeperRepositoryInterface;
use App\Repository\PenaltyRepositoryInterface;
use App\Repository\PlayerRepositoryInterface;
use App\Repository\RefereeRepositoryInterface;
use App\Repository\TeamRepositoryInterface;
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
        $this->app->bind(RefereeRepositoryInterface::class,RefereeRepository::class);
        $this->app->bind(TeamRepositoryInterface::class,TeamRepository::class);
        $this->app->bind(PenaltyRepositoryInterface::class,PenaltyRepository::class);
        $this->app->bind(PenaltyGoalKeeperRepositoryInterface::class,PenaltyGoalKeeperRepository::class);
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
