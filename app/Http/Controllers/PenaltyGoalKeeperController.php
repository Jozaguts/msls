<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenaltyGoalKeeperStoreRequest;
use App\Http\Requests\PenaltyGoalKeeperUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\PenaltyGoalkeeper;
use App\Repository\Eloquent\BaseRepository;
use JetBrains\PhpStorm\Pure;

class PenaltyGoalKeeperController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(PenaltyGoalkeeper $model)
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

    public function store(PenaltyGoalKeeperStoreRequest $request): BaseResource
    {
        return new BaseResource(
            $this->repository->create($request->only('game_id','team_id','player_id')
            ));
    }

    public function update(PenaltyGoalKeeperUpdateRequest $request,$id): BaseResource
    {
        return new BaseResource(
            $this->repository->update($request->only('game_id','team_id','player_id'),$id));
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
