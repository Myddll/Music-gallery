<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/css/font-awesome.min.css'])
    @vite(['resources/js/album.js', 'resources/js/artist.js'])

</head>
<body class="bg-stone-800 text-white">

@yield('content')


</body>
</html>
