<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\Auth\AuthRepositoryInterface;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    private AuthService $service;
    private AuthRepositoryInterface $repository;

    public function __construct(
        AuthRepositoryInterface $repository,
        AuthService    $service
    )
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function loginForm() : View
    {
        return view('auth.login');
    }

    public function loginProcess(LoginRequest $request) : RedirectResponse
    {
        $data = $request->validated();

        if(auth("web")->attempt($data))
        {
            return redirect(route("home"));
        }

        return redirect(route("auth.login-form"))->withErrors(["email" => "Пользователь не найден, или данные введены неверно!"]);
    }

    public function registerForm() : View
    {
        return view('auth.register');
    }

    public function registerProcess(RegisterRequest $request) : View|RedirectResponse
    {
        $data = $request->validated();
        $search = $data['email'];
        $user = $this->repository->findUser(['email' => $search]);

        if ($user) {
            return view('auth.register')->withErrors(["email" => "Пользователь уже существует!"]);
        }

        $this->service->register($data);

        return redirect(route('home'));
    }

    public function logout() : RedirectResponse
    {
        auth("web")->logout();

        return redirect(route("home"));
    }
}
