@extends('components.header')

@section('title', 'Регистрация')
@section('content')

    <div class="h-screen bg-stone-800 text-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-purple-900 w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl text-white font-medium">Регистрация</h1>

            <form action="{{route("auth.register-process")}}" method="POST" class="space-y-5 mt-5">
                @csrf
                <input name="name" type="text" class="w-full text-black h-12 bg-stone-200 border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Имя" />

                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="email" type="text" class="w-full text-black h-12 bg-stone-200 border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full text-black h-12 bg-stone-200 border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password_confirmation" type="password" class="w-full text-black h-12 bg-stone-200 border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Повторите пароль" />

                @error('password_confirmation')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="flex justify-between">
                    <a href="{{ route("auth.login-form") }}" class="font-medium text-white hover:bg-violet-300 rounded-md p-2">Вход</a>
                    <a href="{{ route("home") }}" class="font-medium text-white hover:bg-violet-300 rounded-md p-2">Главная</a>
                </div>



                <button type="submit" class="text-center text-white w-full bg-violet-400 hover:bg-violet-300 rounded-md py-3 font-medium">Регистрация</button>
            </form>
        </div>
    </div>
@endsection
