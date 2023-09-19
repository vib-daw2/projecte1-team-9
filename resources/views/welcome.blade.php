<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blogify</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')

</head>

<body class="antialiased">
    <x-navbar />
    <div class="w-full min-h-screen bg-gray-50 flex justify-center flex-col items-start px-12 pt-20">
        <div class="flex flex-row flex-wrap gap-2 justify-start items-center max-w-3xl w-full mx-auto">
            @foreach ($categories as $category)
                <a class="ring-1 ring-black px-2 py-1 rounded-md {{ $selected == $category ? 'bg-gray-900 hover:bg-gray-900/80 text-white' : '' }}"
                    href={{ sprintf('/?category=%s', urlencode($category)) }}>{{ $category }}</a>
            @endforeach
        </div>
        <div class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-center gap-3">
            @for ($i = 0; $i < 5; $i++)
                <x-postlist :username="sprintf('User %d', $i)" :title="sprintf('Post %d', $i)" :id="$i" />
            @endfor
        </div>
    </div>
</body>

</html>
