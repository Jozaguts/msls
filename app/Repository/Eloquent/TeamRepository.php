<?php


namespace App\Repository\Eloquent;


use App\Models\Team;
use App\Repository\TeamRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    #[Pure] public function __construct(Team $model)
    {
        parent::__construct($model);
    }
}
