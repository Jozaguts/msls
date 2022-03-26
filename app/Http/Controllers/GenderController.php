<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenderRequest;
use App\Http\Resources\BaseResource;
use App\Models\Gender;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\Pure;

class GenderController extends Controller
{
    protected BaseRepository $repository;

    #[Pure] public function __construct(Gender $model)
    {
        $this->repository = new BaseRepository($model);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): BaseResource
    {
        return new BaseResource($this->repository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GenderRequest $request
     * @return BaseResource
     */
    public function store(GenderRequest $request): BaseResource
    {

        return  new BaseResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GenderRequest $request
     * @param int $id
     * @return Response|BaseResource
     */
    public function update(GenderRequest $request, int $id): Response|BaseResource
    {
        return new BaseResource($this->repository->update($request->validated(), $id));
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
