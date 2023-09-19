<div class="w-full flex px-12 h-16 fixed inset-0 bg-white drop-shadow-lg justify-between items-center">
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <a class="text-3xl font-semibold" href="/">Blogify</a>
    @guest
        <div class="flex gap-3">
            <a href="/login"
                class="block w-[100px] text-center py-2 border border-black rounded-lg hover:bg-gray-100 font-medium">Log
                In</a>
            <a href="/signup"
                class="w-[100px] block text-center py-2 bg-gray-900 text-white hover:bg-gray-900/80 rounded-lg font-medium">Sign
                Up</a>
        </div>
    @endguest
    @auth
        <div class="flex justify-center items-center gap-6">
            <button
                class="bg-white hover:bg-gray-100 shadow-md text-black border border-black flex justify-center items-center gap-2 py-2 font-medium w-[150px] rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                New Post
            </button>
            <div class="w-10 h-10 rounded-full bg-black flex items-center justify-center cursor-pointer text-white">A</div>
        </div>
    @endauth

</div>
