<?php


namespace App\Repository\Eloquent;


use App\Models\Referee;
use App\Repository\RefereeRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class RefereeRepository extends BaseRepository implements RefereeRepositoryInterface
{
    #[Pure] public function __construct(Referee $model)
    {
        parent::__construct($model);
    }
}
