@extends('components.header')

@section('title', 'Редактировать артиста')
@section('content')
    <div class="w-full">
        @include('components.nav')
        <main class="lg:px-28 sm:px-14 px-8 mt-10 flex md:justify-center flex-col md:flex-row gap-3">
            <div class="md:w-1/2">
                <form method="post" action="{{ route('artist.update', $artist->id) }}" class="flex flex-col">
                    @csrf
                    @method('PUT')
                    <label for="name">Автор</label>
                    <input type="text" name="name" value="{{ $artist->name }}" class="text-black pl-2 h-10 mb-4 rounded-md" id="artist" list="datalist_artist" required>
                    <datalist id="datalist_artist">

                    </datalist>

                    @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label for="photo">Ссылка на изображение</label>
                    <input type="text" name="photo" placeholder="{{ $artist->photo }}" class="text-black pl-2 h-10 mb-4 rounded-md" id="photo" list="datalist_photo">
                    <datalist id="datalist_photo">

                    </datalist>

                    @error('photo')
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
