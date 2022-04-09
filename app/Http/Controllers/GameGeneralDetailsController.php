<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameGeneralDetailsStoreRequest;
use App\Http\Resources\BaseResource;
use App\Models\GameGeneralDetails;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class GameGeneralDetailsController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(GameGeneralDetails $model)
    {
        $this->repository = new BaseRepository($model);
    }

    public function index(Request $request): BaseResource
    {
        return new BaseResource($this->repository->all($request));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameGeneralDetailsStoreRequest $request): BaseResource
    {
        return new BaseResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return BaseResource
     */
    public function show(int $id): BaseResource
    {
        return new BaseResource($this->repository->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return BaseResource
     */
    public function destroy(int $id): BaseResource
    {

        return new BaseResource($this->repository->delete($id));
    }
}
