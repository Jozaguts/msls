<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameActionDetailStoreRequest;
use App\Http\Requests\GameActionDetailUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\GameActionDetail;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class GameActionDetailController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(GameActionDetail $model)
    {
        $this->repository = new BaseRepository($model);
    }


    public function index(Request $request): BaseResource
    {
        return new BaseResource($this->repository->all($request));
    }


    public function store(GameActionDetailStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->validated()));
    }


    public function show($id): BaseResource
    {
        return new BaseResource($this->repository->find($id));
    }


    public function update(GameActionDetailUpdateRequest $request, $id): BaseResource
    {
        return new BaseResource($this->repository->update($request->validated(),$id));
    }


    public function destroy($id): BaseResource
    {
        return new BaseResource($this->repository->delete($id));
    }
}
