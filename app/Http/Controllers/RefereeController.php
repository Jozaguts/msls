<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefereeStoreRequest;
use App\Http\Requests\RefereeUpdateRequest;
use App\Http\Resources\RefereeResource;
use App\Models\Referee;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\RefereeRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class RefereeController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Referee $model)
    {
        $this->repository = new BaseRepository($model);

    }
    public function index(): RefereeResource
    {
        return new RefereeResource($this->repository->all());
    }
    public function show($id): RefereeResource
    {
        return new RefereeResource($this->repository->find($id));
    }
    public function store(RefereeStoreRequest $request): RefereeResource
    {
        return new RefereeResource($this->repository->create($request->only('name','age')));
    }
    public function update(RefereeUpdateRequest $request,$id): RefereeResource
    {
        return new RefereeResource($this->repository->update($request->only('name','age'),$id));
    }
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
