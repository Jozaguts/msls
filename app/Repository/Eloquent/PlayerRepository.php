<?php


namespace App\Repository\Eloquent;


use App\Models\Player;
use App\Repository\PlayerRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class PlayerRepository extends BaseRepository implements PlayerRepositoryInterface
{
    #[Pure] public function __construct(Player $model)
    {
        parent::__construct($model);
    }
}
