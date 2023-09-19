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
            <x-profiletabs selected="profile" />
            <div class="flex flex-row w-full h-fit justify-between mt-4 gap-4">
                <x-profilestats />
                <form class="flex flex-col gap-3 w-2/3 pt-6">
                    <div class="w-full">
                        <label class="block">Username</label>
                        <input type="text" name="username" id="username"
                            class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
                    </div>
                    <div class="w-full">
                        <label class="block">Password</label>
                        <input type="password" name="password1" id="password1"
                            class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
                    </div>
                    <div class="w-full">
                        <label class="block">Repeat Password</label>
                        <input type="password" name="password2" id="password2"
                            class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
                    </div>
                    <div class="w-full flex justify-end">
                        <button
                            class="w-28 py-2 rounded-md bg-gray-900 hover:bg-gray-900/90 text-white font-medium flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-save">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
