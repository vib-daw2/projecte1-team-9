<label
    for="nots"
    id="not-btn"
    class="hover:text-white peer:checked:[&>div]:block relative hover:bg-gray-900 w-2/3 py-2 rounded-md flex justify-center items-center group">

    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell">
        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
    </svg>
    <div id="not-modal" class="absolute w-96 h-48 left-20 top-0 bg-white hidden drop-shadow-lg border rounded-lg"></div>
</label>
<input type="checkbox" name="nots" id="nots" class="peer hidden">

<script>
    const label = document.getElementById("not-btn")
    
    label.addEventListener("click", () => {
        const input = document.getElementById("nots")
        const modal = document.getElementById("not-modal")
        if (input.checked){
            modal.classList.remove("block")
            modal.classList.add("hidden")
        } else {
            modal.classList.add("block")
            modal.classList.remove("hidden")
        }
    })
</script>