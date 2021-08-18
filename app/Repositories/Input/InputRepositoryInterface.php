<?php
namespace App\Repositories\Input;

use App\Repositories\Contracts\RepositoryInterface;

interface InputRepositoryInterface extends RepositoryInterface
{
    public function findBy($dateFrom, $dateTo,$category_id,$status);
    public function getinput();
}