<?php

namespace App\Repositories\Export;

use App\Repositories\Eloquent\RepositoryEloquent;
use App\Repositories\Export\ExportRepositoryInterface;
use App\Models\Export;
use App\Traits\ResponseAPI;
use App\Http\Resources\CodeResource;
use Carbon\Carbon;

class ExportRepositoryEloquent extends RepositoryEloquent implements ExportRepositoryInterface
{
    public function model()
    {
        return Export::class;
    }

    public function findBy($dateFrom, $dateTo, $category_id, $status)
    {

        $query = $this->model->newQuery();
        if (!empty($category_id)) {
            // dd($category_id);
            $query = $this->model->where('category_id', $category_id);
        }
        if (!empty($status)) {
            $query = $this->model->where('status', $status);
            if (!empty($dateFrom) && !empty($dateTo)) {
                if (!empty($category_id)) {
                    // dd($category_id);
                    $query = $this->model->whereBetween('date', [$dateFrom, $dateTo])->where('status', $status)->where('category_id', $category_id);
                }else{
                    $query = $this->model->whereBetween('date', [$dateFrom, $dateTo])->where('status', $status);
                }  
            }
        }
        if (!empty($dateFrom) && !empty($dateTo) && !empty($category_id)) {

            $query = $this->model->whereBetween('date', [$dateFrom, $dateTo])->where('category_id', $category_id);
        }
        if (!empty($dateFrom) && !empty($dateTo) && !empty($status) && !empty($category_id)) {

            $query = $this->model->whereBetween('date', [$dateFrom, $dateTo])->where('category_id', $category_id)->where('status', $status);
        }
        
        // if (!empty($dateFrom)) {

        //     $query = $this->model->where('date', ">=", "$dateFrom");
        // }
        // dd($query->toSql());
        return $query->orderBy('date', 'desc');
    }
    public function getinput()
    {
        $query = $this->model->newQuery();

        return $query;
    }
}
