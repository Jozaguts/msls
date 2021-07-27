<?php


namespace App\Repository\Eloquent;


use App\Models\Penalty;
use App\Repository\PenaltyRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class PenaltyRepository extends BaseRepository implements PenaltyRepositoryInterface
{
    #[Pure] public function __construct(Penalty $model)
    {
        parent::__construct($model);
    }
}
