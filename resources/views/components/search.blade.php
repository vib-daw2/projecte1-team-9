<button
    id="open-search"
            class="hover:text-white hover:bg-gray-900 w-2/3 py-2 rounded-md flex mx-auto justify-center items-center hover:rounded-r-none group relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-search">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
            </svg>
            <div
                class="hidden group-hover:block absolute top-0 left-16 text-center bg-gray-900 text-white rounded-r-md  w-24 px-2 py-2">
                Search</div>
        </button>
        <dialog id="searchbar" class="w-[350px] h-fit py-4 px-2  inset-0 bg-white flex justify-center items-center rounded-lg">
            <div class="flex flex-row justify-between items-center">
            <input type="search" name="search" id="search-input" class="w-[300px] mx-auto p-2">
            <button>Search</button>
            </div>
        </dialog>
        <script>
            const openSearch = document.getElementById('open-search');
            const searchbar = document.getElementById('searchbar');
            const searchInput = document.getElementById('search-input');
            openSearch.addEventListener('click', () => {
                searchbar.showModal();
            });
            searchbar.addEventListener('click', () => {
                searchbar.close();
            });
            searchInput.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        </script>