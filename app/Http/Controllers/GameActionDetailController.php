<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameActionDetailStoreRequest;
use App\Http\Resources\BaseResource;
use App\Models\GameActionDetail;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class GameActionDetailController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(GameActionDetail $model)
    {
        $this->repository = new BaseRepository($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return BaseResource
     */
    public function index(Request $request): BaseResource
    {
        return new BaseResource($this->repository->all($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GameActionDetailStoreRequest $request
     * @return BaseResource
     */
    public function store(GameActionDetailStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
