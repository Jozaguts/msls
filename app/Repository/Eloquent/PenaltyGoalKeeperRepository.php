<?php


namespace App\Repository\Eloquent;


use App\Models\PenaltyGoalkeeper;
use App\Repository\PenaltyGoalKeeperRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class PenaltyGoalKeeperRepository extends BaseRepository implements PenaltyGoalKeeperRepositoryInterface
{
    #[Pure] public function __construct(PenaltyGoalkeeper $model)
    {
        parent::__construct($model);
    }
}
