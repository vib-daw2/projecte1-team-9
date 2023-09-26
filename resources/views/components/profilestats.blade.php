<div class="w-full h-full pb-4 border-b border-b-black">
    <div class="w-36 h-36 mx-auto bg-black flex justify-center items-center text-white text-4xl rounded-full">
        {{$username[0]}}
    </div>
        {{-- TODO FIX --}}
    <div class="font-medium mt-4 text-center text-lg">@ {{$username}}</div>
    <div class="mt-4 font-base text-lg px-4 flex flex-row gap-2 w-full justify-between">
        <div class="py-1 w-1/3 text-center"><b>{{$likes}}</b> Likes</div>
        <div class="py-1 w-1/3 text-center"><b>{{$posts}}</b> Posts</div>
        <div class="py-1 w-1/3 text-center">Up since <b>08/2023</b></div>
    </div>
</div>
