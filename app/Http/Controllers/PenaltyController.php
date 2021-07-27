<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenaltyStoreRequest;
use App\Http\Requests\PenaltyUpdateRequest;
use App\Http\Resources\PenaltyResource;
use App\Repository\PenaltyRepositoryInterface;

class PenaltyController extends Controller
{
    protected PenaltyRepositoryInterface $repository;
    public function __construct(PenaltyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): PenaltyResource
    {
        return new PenaltyResource($this->repository->all());
    }

    public function show($id): PenaltyResource
    {
        return new PenaltyResource($this->repository->find($id));
    }
    public function store(PenaltyStoreRequest $request): PenaltyResource
    {
        return new PenaltyResource($this->repository->create(
            $request->only('game_id', 'team_id', 'player_id', 'score_goal', 'kicks_number')
        ));
    }
    public function update(PenaltyUpdateRequest $request, $id): PenaltyResource
    {
        return new PenaltyResource($this->repository->update(
            $request->only('game_id', 'team_id', 'player_id', 'score_goal', 'kicks_number'),$id)
        );
    }
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
