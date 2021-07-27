<?php
namespace App\Repositories\Code;

use app\Repositories\Code\CodeRepositoryInterface;
use app\Repositories\Eloquent\RepositoryEloquent;
use App\Traits\ResponseAPI;



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
        if(!empty($keyword)) {
            $query = $this->model->where('code', 'like', "%$keyword%");
        }

        return $query;
    }
    public function getAll(){
        $result = $this->_model->all();

        return $result;
    }

}