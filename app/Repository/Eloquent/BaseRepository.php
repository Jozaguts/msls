<?php


namespace App\Repository\Eloquent;


use App\Repository\BaseRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\String\s;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;
    const SUCCESS_RESPONSE = ['success' => true, 'message' => 'action was successfully processed'];
    const ERROR_RESPONSE = ['success' => false, 'message' => "error action wasn't processed"];
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
            return (env('APP_ENV') != 'production')
                ? ['message'=>  $e->getMessage()]
                : ['message'=> 'oops! something went wrong please try again.'];
        }
    }

    public function all(): array | Collection
    {
        try{
           return $this->model::all();
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return (env('APP_ENV') != 'production')
                ? ['message'=>  $e->getMessage()]
               : static::ERROR_RESPONSE;
        }
    }

    public function create(array $properties): array | Model
    {
        try{
            return $this->model->create($properties);
        }catch(\Exception $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
           return (env('APP_ENV') != 'production')
               ? ['message'=>  $e->getMessage()]
               : static::ERROR_RESPONSE;
        }
    }

    public function update(array $properties, int $id): array|Model
    {
        try{
            if (! $this->find($id)) {
               return ['message' =>'register not found!'];
            }
            $this->model::where('id', $id)
                ->where('deleted_at', null)
                ->update($properties);
            return $this->find($id);
        }catch(QueryException $e ){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return (env('APP_ENV') != 'production')
                ? ['message'=>  $e->getMessage()]
                : static::ERROR_RESPONSE;
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
            return (env('APP_ENV') != 'production')
                ? ['message'=>  $e->getMessage()]
                : ['message'=> 'oops! something went wrong please try again.'];
        }
    }

     public function delete(int $id)
    {
        try{
            $model = $this->find($id);
            if ( $model instanceof Model ) {
                $model->delete();
                return ['message' => 'register was deleted successfully'];
            } else {
                return ['message' => "register didn't find it"];
            }
        }
        catch(QueryException | Exception  $e){
            Log::error($e->getMessage(),['Line' =>$e->getLine()]);
            return (env('APP_ENV') != 'production')
                ? ['message'=>  $e->getMessage()]
                : ['message'=> 'oops! something went wrong please try again.'];
        }
    }
}
