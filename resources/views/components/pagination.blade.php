<div class="w-full font-medium max-w-5xl mx-auto mt-4 flex justify-center gap-2">
    @for($i = 0; $i < 15; $i++)
        <a href="{{ url()->current() }}?{{ http_build_query(request()->except('page')) }}&page={{ $i + 1 }}" class="w-8 h-8 {{$current == ($i + 1) ? "bg-gray-900 text-white" : "hover:bg-gray-900 hover:text-white"}} flex ring-1 ring-black justify-center items-center rounded-md ">{{ $i + 1}}</a>
    @endfor
</div>