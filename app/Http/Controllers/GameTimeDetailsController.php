<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameTimeDetailsStoreRequest;
use App\Http\Requests\GameTimeDetailsUpdateRequest;
use App\Http\Resources\BaseResource;
use App\Models\GameTimeDetail;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\Pure;

class GameTimeDetailsController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(GameTimeDetail $model)
    {
        $this->repository = new BaseRepository($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|BaseResource
     */
    public function index(Request $request): Response|BaseResource
    {
        return new BaseResource($this->repository->all($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GameTimeDetailsStoreRequest $request
     * @return BaseResource
     */
    public function store(GameTimeDetailsStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return BaseResource
     */
    public function show(int $id): BaseResource
    {
        return new BaseResource($this->repository->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GameTimeDetailsUpdateRequest $request
     * @param int $id
     * @return BaseResource
     */
    public function update(GameTimeDetailsUpdateRequest $request, $id): BaseResource
    {
        return new BaseResource($this->repository->update($request->validated(),$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response|BaseResource
     */
    public function destroy(int $id): Response|BaseResource
    {
        return new BaseResource($this->repository->delete($id));
    }
}
