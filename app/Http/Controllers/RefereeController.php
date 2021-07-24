<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefereeStoreRequest;
use App\Http\Requests\RefereeUpdateRequest;
use App\Http\Resources\RefereeResource;
use App\Repository\RefereeRepositoryInterface;

class RefereeController extends Controller
{
    private RefereeRepositoryInterface $repository;
    public function __construct(RefereeRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
