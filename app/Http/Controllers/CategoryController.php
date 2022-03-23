<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repository\BaseRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use JetBrains\PhpStorm\Pure;

class CategoryController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Category $model)
    {
        $this->repository = new BaseRepository($model);

    }

    public function index(): CategoryResource
    {

        return new CategoryResource($this->repository->all());
    }

    public function show($id): CategoryResource
    {
        return new CategoryResource($this->repository->find($id));
    }

    public function store(CategoryStoreRequest $request): CategoryResource
    {
        return new CategoryResource($this->repository->create($request->only('name','gender_id')));
    }

    public function update(CategoryUpdateRequest $request, $id): CategoryResource
    {
        return new CategoryResource($this->repository->update( $request->only('name','gender_id'),$id));
    }

    public function destroy($id): array
    {
        return $this->repository->delete($id);
    }
}
