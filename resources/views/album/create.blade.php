@extends('components.header')

@section('title', 'Добавить альбом')
@section('content')
    <div class="w-full">
        @include('components.nav')
        <main class="lg:px-28 sm:px-14 px-8 mt-10 flex md:justify-center flex-col md:flex-row gap-3">
            <div class="md:w-1/2">
                <form method="post" action="{{ route('album.store') }}" class="flex flex-col">
                    @csrf
                    <label for="album_title">Название альбома</label>
                    <input type="text" name="name" list="datalist_album" class="text-black pl-2 h-10 mb-4 rounded-md" id="album_title" required>
                    <datalist id="datalist_album">

                    </datalist>
                    @error('album_title')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label for="artist_name">Автор</label>

                    <input type="text" name="artist_name" list="datalist_artist" class="text-black pl-2 h-10 mb-4 rounded-md" id="artist_name" required>
                    <datalist id="datalist_artist">
                        @foreach($artists as $artist)
                            <option value="{{ $artist->name }}">{{ $artist->name }}</option>
                        @endforeach
                    </datalist>

                    @error('artist_name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror


                    <label for="description">Описание</label>
                    <input type="text" name="description" class="text-black pl-2 h-10 mb-4 rounded-md" id="description">

                    @error('description')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label for="cover">Ссылка на изображение</label>
                    <input type="text" name="cover" class="text-black pl-2 h-10 mb-4 rounded-md" id="cover">

                    @error('cover')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    @error('status')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="w-36 h-12 bg-violet-400 rounded-md text-xl transition hover:bg-violet-500">Сохранить</button>
                </form>
            </div>
        </main>
    </div>
@endsection
