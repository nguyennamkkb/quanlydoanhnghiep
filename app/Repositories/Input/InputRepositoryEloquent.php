<?php

namespace App\Repositories\Input;

use App\Repositories\Eloquent\RepositoryEloquent;
use App\Repositories\Input\InputRepositoryInterface;
use App\Models\Input;
use App\Traits\ResponseAPI;
use App\Http\Resources\CodeResource;


class InputRepositoryEloquent extends RepositoryEloquent implements InputRepositoryInterface
{
    public function model()
    {
        return Input::class;
    }

    public function findBy($keyword,$shortName, $phone)
    {
        $query = $this->model->newQuery();
        if (!empty($address)) {

            $query = $this->model->where('address', 'like', "%$address%");
        }
        if (!empty($phone)) {
            $query = $this->model->where('phone', 'like', "%$phone%");
        }
        if (!empty($keyword)) {
            $query = $this->model->where('name', 'like', "%$keyword%");
        }

        return $query->orderBy('name', 'desc');
    }

}
