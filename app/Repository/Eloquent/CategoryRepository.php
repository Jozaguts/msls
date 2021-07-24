<?php


namespace App\Repository\Eloquent;


use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    #[Pure] public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
