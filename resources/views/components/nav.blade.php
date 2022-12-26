<nav class="w-full flex justify-between bg-purple-900 lg:px-28 sm:px-14 px-8 py-3 h-16 content-center">
    <a href="{{ route('home') }}" class="flex items-center font-bold text-2xl no-underline hover:text-black transition">Music Gallery</a>

    <form class="flex justify-center bg-white rounded-lg p-1" method="GET" action="{{ route('find-artists-by-name') }}">
        <input type="text" name="artist" class="text-black rounded-lg" placeholder="Поиск по артисту" value="{{ old('artist') ?: '' }}">
        <button type="submit" class="text-black">Поиск</button>
    </form>

    @auth('web')
        <a href="{{ route('auth.logout') }}" class="bg-violet-400 w-24 pt-1 rounded-md text-xl text-center transition hover:bg-violet-500 no-underline">Log out</a>
    @endauth
    @guest('web')
        <a href="{{ route('auth.login-form') }}" class="bg-violet-400 w-24 pt-1 rounded-md text-xl text-center transition hover:bg-violet-500 no-underline">Log in</a>
    @endauth
</nav>
