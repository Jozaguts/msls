<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefereeStoreRequest;
use App\Http\Requests\RefereeUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\Referee;
use App\Repository\Eloquent\BaseRepository;
use JetBrains\PhpStorm\Pure;

class RefereeController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Referee $model)
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
    public function store(RefereeStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->only('name','age')));
    }
    public function update(RefereeUpdateRequest $request,$id): BaseResource
    {
        return new BaseResource($this->repository->update($request->only('name','age'),$id));
    }
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
