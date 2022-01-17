<?php


namespace App\Repository\Eloquent;


use App\Models\Game;
use App\Repository\GameRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class GameRepository extends BaseRepository implements GameRepositoryInterface
{
    #[Pure] public function __construct(Game $model)
    {
        parent::__construct($model);
    }
}
