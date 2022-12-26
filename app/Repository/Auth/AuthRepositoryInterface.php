<?php

namespace App\Repository\Auth;

interface AuthRepositoryInterface
{
    public function createUser(array $params);

    public function findUser(array $params);
}
