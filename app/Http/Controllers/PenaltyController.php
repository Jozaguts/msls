<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenaltyStoreRequest;
use App\Http\Requests\PenaltyUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\Penalty;
use App\Repository\Eloquent\BaseRepository;
use JetBrains\PhpStorm\Pure;

class PenaltyController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Penalty $model)
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
    public function store(PenaltyStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create(
            $request->validated()
        ));
    }
    public function update(PenaltyUpdateRequest $request, $id): BaseResource
    {
        return new BaseResource($this->repository->update(
            $request->validated(),$id)
        );
    }
    public function destroy($id): BaseResource
    {
        return new BaseResource($this->repository->delete($id));
    }
}
