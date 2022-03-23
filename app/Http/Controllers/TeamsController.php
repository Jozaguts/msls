<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class TeamsController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Team $model)
    {
        $this->repository = new BaseRepository($model);

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
