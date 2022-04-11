<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineupStoreRequest;
use App\Http\Requests\LineupUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\Lineup;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class LineupsController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Lineup $model)
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
    public function store(LineupStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->validated()));
    }
    public function update(LineupUpdateRequest $request, $id): BaseResource
    {
        return new BaseResource($this->repository->update($request->validated(),$id));
    }
    public function destroy($id): BaseResource
    {
        return new BaseResource($this->repository->delete($id));
    }
}
