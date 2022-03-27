<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\BaseResource;
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

    public function index(): BaseResource
    {

        return new BaseResource($this->repository->all());
    }

    public function show($id): BaseResource
    {
        return new BaseResource($this->repository->find($id));
    }

    public function store(CategoryStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->only('name','gender_id')));
    }

    public function update(CategoryUpdateRequest $request, $id): BaseResource
    {
        return new BaseResource($this->repository->update( $request->only('name','gender_id'),$id));
    }

    public function destroy($id): BaseResource
    {
        return new BaseResource( $this->repository->delete($id));
    }
}
