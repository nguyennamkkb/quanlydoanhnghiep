<?php

namespace App\Repositories\Code;

use App\Repositories\Eloquent\RepositoryEloquent;
use App\Repositories\Code\CodeRepositoryInterface;
use App\Models\Code;
use App\Traits\ResponseAPI;
use App\Http\Resources\CodeResource;


class CodeRepositoryEloquent extends RepositoryEloquent implements CodeRepositoryInterface
{
    use ResponseAPI;
    public function model()
    {
        return Code::class;
    }

    public function findBy($status, $keyword, $slide)
    {
        $query = $this->model->newQuery();

        // if(!empty($status)) {
        //     $query = $this->model->where('status', $status);
        // }
        // if(!empty($slide)) {
        //     $query = $this->model->where('slide', $slide);
        // }
        if (!empty($keyword)) {
            $query = $this->model->where('code', 'like', "%$keyword%");
        }

        return $query;
    }
    public function getAll()
    {
        $query = $this->model->all();

        
        // try {
        //     $query = CodeResource::collection($query);
        //     return $this->success("All Codes", $query);
        // } catch (\Exception $e) {
        //     return $this->error($e->getMessage(), $e->getCode());
        // }
        return $query;
    }
}

// try {
//     $codes = CodeResource::collection(Code::all());
//     return $this->success("All Codes",$codes);
// } catch(\Exception $e) {
//     return $this->error($e->getMessage(), $e->getCode());
// }