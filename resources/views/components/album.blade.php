<div class="max-w-xs w-full">
    <div>
        <div class="flex justify-end">
            @if(auth("web")->id() === $album->user_id)
                <form method="POST" action="{{ route('album.destroy', $album->id) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="pr-3"><i class="fa fa-trash text-red-800 text-5xl transition hover:text-red-900" aria-hidden="true"></i></button>
                </form>
                    <a href="{{ route('album.edit', $album->id) }}"><i class="fa fa-pencil-square-o text-green-500 text-5xl transition hover:text-green-600" aria-hidden="true"></i></a>
            @endif
        </div>
        <img src="@if($album->cover === null){{ asset("storage/placeholder.jpg") }} @else{{ asset("storage/albums/{$album->cover}") }}@endif" class="w-full h-full" alt="cover">
    </div>
    <div class="bg-stone-600 pt-1 rounded-b-lg">
        <h2 class="md:ml-8 ml-2 text-2xl font-bold">{{ $album->name }}, <a href="{{ route('search-albums-by-artist', $album->artist->id) }}" class="underline hover:text-black transition">{{ $album->artist->name }}</a></h2>
        <h3 class="ml-2 text-clip overflow-hidden">{{ $album->description }}</h3>
    </div>
</div>
