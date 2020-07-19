<?php
namespace App\traits;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;


trait ApiResponser

{
    private function successResponse($data,$code){
        return response()->json($data,$code);
    }

    protected function errorResponse($message,$code){
        return response()->json(['error'=>$message,'code'=>$code],$code);
    }

    protected function showAll(Collection $collection, $code=200){
        return $this->successResponse(['data'=>$collection],$code);
    }
    protected function showEloquent($paginator, $code=200){
        return $this->successResponse(['data'=>$paginator],$code);
    }

    protected function showOne(Model $model, $code=200){
        return $this->successResponse(['data'=> $model],$code);
    }

    protected function showWithRelations(Model $model,$comments, $code=200){
        return $this->successResponse(['data'=> $model,'comments'=>$model->$comments],$code);
    }

}