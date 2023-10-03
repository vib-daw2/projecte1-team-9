<form method="POST" action="/logout" class="w-full h-fit lg:my-0 my-auto">
    @csrf
    <button
        class="hover:text-white hover:bg-red-500 w-2/3 py-2 lg:my-0 my-auto rounded-md flex mx-auto justify-center items-center lg:hover:rounded-r-none group relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-log-out">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" x2="9" y1="12" y2="12" />
        </svg>
        <div
            class="hidden lg:group-hover:block absolute top-0 left-16 text-center bg-red-500 text-white rounded-r-md  w-24 px-2 py-2">
            Log Out</div>
    </button>
</form>
