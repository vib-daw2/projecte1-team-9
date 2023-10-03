<a href="{{ $href }}"
    class="hover:text-white relative hover:bg-gray-900 w-2/3 py-2 rounded-md flex justify-center items-center group lg:hover:rounded-r-none">
    <span>{{ $slot }}</span>
    <div class="absolute hidden lg:group-hover:block w-24 text-center drop-shadow-lg left-16 bg-gray-900 rounded-md px-2 py-2 rounded-l-none text-md text-white z-40">{{$title}}</div>
</a>
