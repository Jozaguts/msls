<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStoreRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\Game;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class GameController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Game $model)
    {
        $this->repository = new BaseRepository($model);

    }

    public function index(Request $request): BaseResource
    {
        return new BaseResource($this->repository->all($request));
    }

    public function show($id): BaseResource
    {
        return new BaseResource($this->repository->find($id));
    }

    public function store(GameStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->validated()));
    }


    public function update(GameUpdateRequest $request, $id): BaseResource
    {
        return new BaseResource($this->repository->update($request->validated(),$id));
    }


    public function destroy($id): BaseResource
    {
        return new BaseResource($this->repository->delete($id));
    }
}
