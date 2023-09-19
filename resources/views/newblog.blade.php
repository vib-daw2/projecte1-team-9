<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Blog</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar />
    <div class="w-full min-h-screen flex justify-start flex-col items-center px-12 pt-20">
        <form class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-center gap-3">
            <div class="w-full flex justify-between flex-wrap items-center">
                <div class="text-left text-3xl font-medium">New Post</div>
                <div class="flex flex-row gap-2">
                    <button
                        class="w-28 py-2 rounded-md bg-white hover:bg-gray-100 ring-1 ring-black text-black font-medium flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-save">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Save
                    </button>
                    <button
                        class="w-28 py-2 rounded-md bg-gray-900 hover:bg-gray-900/90 text-white font-medium flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-up-to-line">
                            <path d="M5 3h14" />
                            <path d="m18 13-6-6-6 6" />
                            <path d="M12 7v14" />
                        </svg>
                        Publish
                    </button>
                </div>
            </div>
            <input type="text" name="title" id="title" placeholder="Title"
                class="w-full text-5xl px-2 outline-none font-medium focus:border-0 py-2" />
            <input type="text" name="subtitle" id="subtitle"
                class="w-full text-lg px-2 py-2 font-base focus:outline-none" placeholder="Subtitle">
            <textarea class="w-full px-2 py-2 font-light outline-none decoration-transparent" name="content" id="content"
                rows="20" placeholder="Content"></textarea>
        </form>
    </div>
</body>

</html>
