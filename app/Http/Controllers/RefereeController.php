<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefereeStoreRequest;
use App\Http\Requests\RefereeUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\User;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class RefereeController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(User $model)
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
        $data = array_merge($request->validated(),['password' => Str::random(8)]);
        return new BaseResource($this->repository->create($data));
    }
    public function update(RefereeUpdateRequest $request,$id): BaseResource
    {
        return new BaseResource($this->repository->update($request->validated(),$id));
    }
    public function destroy($id): BaseResource
    {
        return new BaseResource($this->repository->delete($id));
    }
}
