<div class="flex justify-between w-full h-44 border-b border-b-black items-center px-2">
    <img src="http://placekitten.com/200/200" class="w-32 h-32" />
    <div class="h-full w-full flex flex-col justify-start gap-1 items-start py-2 ml-4">
        <div class="w-full flex justify-between items-center">
            <a href={{ sprintf('/blog/%d', $id) }}
                class="block font-semibold hover:underline text-2xl">{{ $title }}</a>
            <x-blog-like :liked="$liked" :likes="5" :id="$id" />
        </div>
        <div class="flex items-center hover:underline cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="w-4 h-4 mr-1">
                <circle cx="12" cy="8" r="5" />
                <path d="M20 21a8 8 0 1 0-16 0" />
            </svg>
            <a href={{sprintf("/user/%d", $ownerid)}} class="font-light">{{ $username }}</a>
        </div>
        <div>
            {{$subtitle}}
        </div>
    </div>

</div>
