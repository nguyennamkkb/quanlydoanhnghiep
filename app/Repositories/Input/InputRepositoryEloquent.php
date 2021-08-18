<?php

namespace App\Repositories\Input;

use App\Repositories\Eloquent\RepositoryEloquent;
use App\Repositories\Input\InputRepositoryInterface;
use App\Models\Input;
use App\Traits\ResponseAPI;
use App\Http\Resources\CodeResource;
use Carbon\Carbon;

class InputRepositoryEloquent extends RepositoryEloquent implements InputRepositoryInterface
{
    public function model()
    {
        return Input::class;
    }

    public function findBy($dateFrom, $dateTo, $category_id, $status)
    {
        // dd($dateFrom, $dateTo, $category_id, $status);
        $query = $this->model->newQuery();
        if (!empty($dateTo) && !empty($dateFrom)) {
            $query = $this->model->whereBetween('date', [$dateFrom,$dateTo]);
        }
        if (!empty($category_id)) {
            $query = $this->model->where('category_id', '=', "$category_id");
        }
        if (!empty($status)) {
            $query = $this->model->where('status', '=', "$status");
        }
    

        return $query->orderBy('date', 'desc');
    }
    public function getinput()
    {
        $query = $this->model->newQuery();

        return $query;
    }

}
