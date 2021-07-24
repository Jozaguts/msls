<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerCollection;
use App\Http\Resources\PlayerResource;
use App\Repository\PlayerRepositoryInterface;
use Illuminate\Http\Request;


class PlayersController extends Controller
{
    private PlayerRepositoryInterface $repository;

    public function __construct(PlayerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): PlayerCollection
    {
        return new PlayerCollection($this->repository->all($request));
    }

    public function show($id): PlayerResource
    {
        return new PlayerResource($this->repository->find($id));
    }

    public function store(Request $request): PlayerResource
    {
       return new PlayerResource($this->repository->create($request->all()));
    }

    public function update(Request $request, $id): PlayerResource
    {

        return new PlayerResource($this->repository->update($request->except('_method'), $id));
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }


}
