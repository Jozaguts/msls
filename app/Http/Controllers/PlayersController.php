<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Http\Resources\PlayerCollection;
use App\Http\Resources\PlayerResource;
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

    public function index(Request $request): PlayerCollection
    {
        return new PlayerCollection($this->repository->paginate($request));
    }

    public function show($id): PlayerResource
    {
        return new PlayerResource($this->repository->find($id));
    }

    public function store(PlayerStoreRequest $request): PlayerResource
    {

       return new PlayerResource($this->repository->create($request->all()));
    }

    public function update(PlayerUpdateRequest $request, $id): PlayerResource
    {
        return new PlayerResource($this->repository->update($request->except('_method'), $id));
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }


}
