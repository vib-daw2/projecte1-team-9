<div class="@if($isResponse) w-[calc(100%-4rem)] ml-[4rem] @else w-full mb-3 drop-shadow-lg shadow-black @endif h-fit px-2 gap-3 py-2 rounded-md flex flex-row justify-start items-start hover:bg-gray-100 bg-gray-50">
    @if($isResponse)
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-corner-down-right"><polyline points="15 10 20 15 15 20"/><path d="M4 4v7a4 4 0 0 0 4 4h12"/></svg>
    @endif
    <div class="w-14 h-14 min-w-fit p-1 bg-gray-900 text-white flex justify-center items-center uppercase rounded-full">A</div>
    <div class="w-fit ml-4">
        <div class="font-semibold">@ {{$user}}</div>
        <div class="mt-2">{{$message}}</div>
    </div>
</div>