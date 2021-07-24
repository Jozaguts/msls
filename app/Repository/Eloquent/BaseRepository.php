<?php


namespace App\Repository\Eloquent;


use App\Repository\BaseRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Log;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all($request):array | Paginator
    {
        try{
            return paginator($this->model::all(), $request);
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine(), 'file' =>$e->getFile()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }

    public function create(array $properties): array | Model
    {
        try{
            return $this->model->create($properties);
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine(), 'file' =>$e->getFile()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }

    public function update(array $properties, int $id)
    {
        try{
            $model = $this->model->where('id', $id)
                ->where('deleted_at',null)->first();
            if(isset($model)){
                $model->update($properties);
                return $this->model->find($id);
            }else {
                return ['message' => 'Something went wrong with the register please try again'];
            }
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine(), 'file' =>$e->getFile()]);
            return ['message' => 'oops! something went wrong please try again.'];
        }

    }

    public function find(int $id)
    {
        try{
            return $this->model->find($id);
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine(), 'file' =>$e->getFile()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }

    public function delete(int $id)
    {
        try{
            $model = $this->find($id);
            if ( isset($model) ) {
                if($model->delete()){
                    return ['message' => 'The register was deleted successfully'];
                }
            }else {
                return ['message' => 'Something went wrong with the register please try again'];
            }
        }
        catch(QueryException | Exception  $e){
            Log::error($e->getMessage(),['Line' =>$e->getLine(), 'file' =>$e->getFile()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }

}
