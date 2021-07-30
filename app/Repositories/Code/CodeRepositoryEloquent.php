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

        if (!empty($keyword)) {
            $query = $this->model->where('code', 'like', "%$keyword%");
        }

        return $query;
    }
    public function getAll()
    {
        try {
            $query = CodeResource::collection($this->model->all());
            return $this->success("codes", $query);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
