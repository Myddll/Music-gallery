<?php


namespace App\Services\Auth;


use App\Repository\Auth\AuthRepository;

class AuthService
{
    private AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }
    public function register($data)
    {
        $registerData = $data;
        $registerData['password'] = bcrypt($registerData['password']);
        $user = $this->repository->findUser(['email' => $data['email']]);

        if (!$user) {
            $registerUser = $this->repository->createUser($registerData);
            auth('web')->login($registerUser);
        }
    }
}
