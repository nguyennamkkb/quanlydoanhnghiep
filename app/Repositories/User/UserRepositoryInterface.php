<?php
namespace App\Repositories\User;

use App\Repositories\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findBy($status, $keyword, $slide);
    public function getAll();
}