<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenaltyGoalKeeperStoreRequest;
use App\Http\Requests\PenaltyGoalKeeperUpdateRequest;
use App\Http\Resources\PenaltyGoalKeeperResource;
use App\Repository\PenaltyGoalKeeperRepositoryInterface;

class PenaltyGoalKeeperController extends Controller
{
    protected PenaltyGoalKeeperRepositoryInterface $repository;

    public function __construct(PenaltyGoalKeeperRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): PenaltyGoalKeeperResource
    {
        return new PenaltyGoalKeeperResource($this->repository->all());
    }
    public function show($id): PenaltyGoalKeeperResource
    {
        return new PenaltyGoalKeeperResource($this->repository->find($id));
    }

    public function store(PenaltyGoalKeeperStoreRequest $request): PenaltyGoalKeeperResource
    {
        return new PenaltyGoalKeeperResource(
            $this->repository->create($request->only('game_id','team_id','player_id')
            ));
    }

    public function update(PenaltyGoalKeeperUpdateRequest $request,$id): PenaltyGoalKeeperResource
    {
        return new PenaltyGoalKeeperResource(
            $this->repository->update($request->only('game_id','team_id','player_id'),$id));
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
