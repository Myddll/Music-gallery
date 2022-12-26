@extends('components.header')

@section('title', 'Авторизация')
@section('content')

    <div class="h-screen bg-stone-800 text-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-purple-900 text-white w-96-sm max-64 shadow-xl rounded p-5">
            <h1 class="text-3xl text-white font-medium">Вход</h1>

            <form action="{{route("auth.login-process")}}" method="POST" class="space-y-5 mt-5">
                @csrf
                <input name="email" type="text" class="w-full text-black h-12 bg-stone-200 border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full text-black h-12 bg-stone-200 border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror



                <div class="flex justify-between">
                    <a href="{{ route("auth.register-form") }}" class="font-medium text-white hover:bg-violet-300 rounded-md p-2">Регистрация</a>
                    <a href="{{ route("home") }}" class="font-medium text-white hover:bg-violet-300 rounded-md p-2">Главная</a>
                </div>



                <button type="submit" class="text-center text-white w-full bg-violet-400 hover:bg-violet-300 rounded-md py-3 font-medium">Войти</button>
            </form>
        </div>
    </div>
@endsection
