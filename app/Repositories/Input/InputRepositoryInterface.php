<?php
namespace App\Repositories\Input;

use App\Repositories\Contracts\RepositoryInterface;

interface InputRepositoryInterface extends RepositoryInterface
{
    public function findBy($keyword,$address, $phone);
}