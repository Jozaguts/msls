<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\Player;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;


class PlayersController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Player $model)
    {
        $this->repository = new BaseRepository($model);

    }

    public function index(Request $request): BaseResource
    {
        return new BaseResource($this->repository->paginate($request));
    }

    public function show($id): BaseResource
    {
        return new BaseResource($this->repository->find($id));
    }

    public function store(PlayerStoreRequest $request): BaseResource
    {

       return new BaseResource($this->repository->create($request->all()));
    }

    public function update(PlayerUpdateRequest $request, $id): BaseResource
    {
        return new BaseResource($this->repository->update($request->except('_method'), $id));
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }


}
