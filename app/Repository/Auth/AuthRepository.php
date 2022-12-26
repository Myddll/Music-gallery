<?php


namespace App\Repository\Auth;


use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function createUser(array $params) : User
    {
        return User::create($params);
    }

    public function findUser(array $params) : ?User
    {
        return User::where($params)->first();
    }
}
