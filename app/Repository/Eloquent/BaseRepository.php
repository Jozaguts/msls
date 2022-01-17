<?php


namespace App\Repository\Eloquent;


use App\Repository\BaseRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
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

    public function paginate($request):array | Paginator
    {
        try{
            return paginator($this->model::all(), $request);
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            if (!auth()->guest()) {
            return ['message'=> 'oops! something went wrong please try again.'];
            }
                return ['message'=> 'oops! something went wrong please try again.','data'=> $e->getMessage()];
        }
    }

    public function all(): array | Collection
    {
        try{
           return $this->model::all();
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }

    public function create(array $properties): array | Model
    {
        try{
            return $this->model->create($properties);
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }

    public function update(array $properties, int $id): array | Model
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
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return ['message' => 'oops! something went wrong please try again.'];
        }

    }

    public function find(int $id): array| Model
    {
        try{
            $model =  $this->model->find($id);
            if($model instanceof Model){
                return $model;
            }else {
                return ['message' => 'Something went wrong with the register please try again'];
            }
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }

     public function delete(int $id)
    {
        try{
            $model = $this->find($id);
            if ( $model instanceof Model ) {
                $model->delete();
                return ['message' => 'The register was deleted successfully'];
            }else {
                return ['message' => "register was didn't find it"];
            }
        }
        catch(QueryException | Exception  $e){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return ['message'=> 'oops! something went wrong please try again.'];
        }
    }
}
