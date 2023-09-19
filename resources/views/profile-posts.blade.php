<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar />
    <div class="w-full min-h-screen flex justify-start flex-col items-center px-12 pt-20">
        <div class="max-w-5xl mt-4 w-full mx-auto h-fit flex flex-col justify-start items-start gap-3">
            <x-profiletabs selected="posts" />
            <div class="flex flex-row w-full h-fit justify-between mt-4 gap-4">
                <x-profilestats />
                <div class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-center gap-3">
                    @for ($i = 0; $i < 5; $i++)
                        <x-postlist :username="sprintf('User %d', $i)" :title="sprintf('Post %d', $i)" :id="$i" />
                    @endfor
                </div>
            </div>
        </div>
    </div>
</body>

</html>
