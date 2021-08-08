<?php

namespace App\Repositories\Customer;

use App\Repositories\Eloquent\RepositoryEloquent;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Traits\ResponseAPI;
use App\Http\Resources\CodeResource;


class CustomerRepositoryEloquent extends RepositoryEloquent implements CustomerRepositoryInterface
{
    public function model()
    {
        return Customer::class;
    }

    public function findBy($keyword,$address, $phone)
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
