<?php

namespace App\Repositories\User;

use App\Repositories\Eloquent\RepositoryEloquent;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use App\Traits\ResponseAPI;
use App\Http\Resources\UserResource;


class UserRepositoryEloquent extends RepositoryEloquent implements UserRepositoryInterface
{
    use ResponseAPI;
    public function model()
    {
        return User::class;
    }

    public function findBy($status, $keyword, $slide)
    {
        $query = $this->model->newQuery();

        if (!empty($keyword)) {
            $query = $this->model->where('name', 'like', "%$keyword%");
        }

        return $query;
    }
    public function getAll()
    {
        try {
            $query = UserResource::collection($this->model->all());
            return $this->success("codes", $query);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
