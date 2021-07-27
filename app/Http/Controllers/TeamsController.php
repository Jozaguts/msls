<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamResource;
use App\Repository\TeamRepositoryInterface;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    protected TeamRepositoryInterface $repository;
    public function __construct(TeamRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): TeamResource
    {
        return new TeamResource($this->repository->paginate($request));
    }

    public function show($id): TeamResource
    {
        return new TeamResource($this->repository->find($id));
    }

    public function store(TeamStoreRequest $request): TeamResource
    {
        return new TeamResource($this->repository->create($request->only('name', 'group', 'category_id', 'won', 'draw', 'lost', 'goals_against', 'goals_for',
            'goals_difference', 'points','gender_id'))
        );
    }


    public function update(TeamUpdateRequest $request, $id): TeamResource
    {
        return new TeamResource($this->repository->update($request->only('name', 'group', 'category_id', 'won', 'draw', 'lost', 'goals_against', 'goals_for',
            'goals_difference', 'points','gender_id'),$id)
        );
    }


    public function destroy($id)
    {
       return $this->repository->delete($id);
    }
}
