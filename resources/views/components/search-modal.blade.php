<div id="search-modal" class="w-full absolute inset-0 h-screen hidden backdrop-blur-sm justify-end items-start">
    <form action="/search" method="GET" class="w-fit bg-gray-200 shadow-lg px-8 py-4">
        @csrf
        <input type="search" name="s" id="s" class="w-[500px] outline-none rounded-md py-1 px-2"
            placeholder="Search...">
    </form>
</div>

<script>
    const modal = document.getElementById('search-modal');

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        const search = document.getElementById('s');
        search.focus();
    }

    function closeModal() {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function toggleModal() {
        if (modal.classList.contains('hidden')) {
            openModal();
        } else {
            closeModal();
        }
    }

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    window.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'f') {
            e.preventDefault();
            openModal();
        }
    })

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    })
</script>
