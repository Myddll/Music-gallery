<div class="max-w-xs w-full">
    <div>
        <div class="flex justify-end">
            @if(auth("web")->id() === $artist->user_id)
                <form method="POST" action="{{ route('artist.destroy', $artist->id) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="pr-3"><i class="fa fa-trash text-red-800 text-5xl transition hover:text-red-900" aria-hidden="true"></i></button>
                </form>
                <a href="{{ route('artist.edit', $artist->id) }}"><i class="fa fa-pencil-square-o text-green-500 text-5xl transition hover:text-green-600" aria-hidden="true"></i></a>
            @endif
        </div>
        <img src="@if($artist->photo === null){{ asset("storage/placeholder.jpg") }}@else{{ asset("storage/artist/{$artist->photo}") }}@endif" class="w-full h-full" alt="cover">
    </div>
    <div class="bg-stone-600 pt-1 rounded-b-lg">
        <a href="{{ route('search-albums-by-artist', $artist->id) }}" class="underline hover:text-black transition"><h2 class="md:ml-8 ml-2 text-2xl font-bold">{{ $artist->name }}</h2></a>
    </div>
</div>
