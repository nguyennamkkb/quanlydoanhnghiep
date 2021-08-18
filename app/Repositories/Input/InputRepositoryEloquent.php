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
        if (!empty($category_id)) {
            $query = $this->model->where('category_id', 'like', "$category_id");
        }
        if (!empty($status)) {
            $query = $this->model->Where('status', '=', "$status");
        }
        if (!empty($dateTo)) {
            if (!empty($category_id)) {
                $query = $this->model->whereBetween('date', [$dateFrom,$dateTo])->where('category_id', 'like', "$category_id");
            }else{
                $query = $this->model->whereBetween('date', [$dateFrom,$dateTo]);
            }
            
        }
        
    
        // dd($query->toSql());
        return $query;
    }
    public function getinput()
    {
        $query = $this->model->newQuery();

        return $query;
    }

}
