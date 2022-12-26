@extends('components.header')

@section('title', 'Главная')
@section('content')
    <div class="w-full">
        @include('components.nav')
        <main class="lg:px-28 sm:px-14 px-8">
            <div class="w-full flex justify-between py-14 gap-3">
                <div class="w-80">
                    @auth("web")
                        <a href="{{ route('album.create') }}"><button class="w-36 h-12 bg-violet-400 rounded-md text-xl transition hover:bg-violet-500">Add album</button></a>
                        <a href="{{ route('artist.create') }}"><button class="w-36 h-12 bg-violet-400 rounded-md text-xl transition hover:bg-violet-500">Add artist</button></a>
                    @endauth
                </div>
                <h1>Альбомы</h1>
                <div>
                    <a href="{{ route('all-artists') }}" class="hover:text-black transition">Все артисты</a>
                </div>
            </div>
            <div class="flex content-center flex-wrap justify-center gap-3">
                @foreach($albums as $album)
                    @include('components.album', ['album' => $album])
                @endforeach
            </div>

        </main>
        <div class="lg:px-28 sm:px-14 px-8">
            <div class="flex justify-center mt-4">
                {{ $albums->links() }}
            </div>
        </div>
    </div>
@endsection
