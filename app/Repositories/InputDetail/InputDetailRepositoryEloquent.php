<?php

namespace App\Repositories\InputDetail;

use App\Repositories\Eloquent\RepositoryEloquent;
use App\Repositories\InputDetail\InputDetailRepositoryInterface;
use App\Models\InputDetail;
use App\Traits\ResponseAPI;
use App\Http\Resources\CodeResource;


class InputDetailRepositoryEloquent extends RepositoryEloquent implements InputDetailRepositoryInterface
{
    public function model()
    {
        return InputDetail::class;
    }

    public function findBy($keyword)
    {
        $query = $this->model->newQuery();
        // if (!empty($address)) {

        //     $query = $this->model->where('address', 'like', "%$address%");
        // }
        // if (!empty($phone)) {
        //     $query = $this->model->where('phone', 'like', "%$phone%");
        // }
        // if (!empty($keyword)) {
        //     $query = $this->model->where('name', 'like', "%$keyword%");
        // }

        return $query;
    }

}
