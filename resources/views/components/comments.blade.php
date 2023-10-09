
<label for="display-comments" class="text-gray-600 p-2 hover:bg-gray-100 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-messages-square"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg></label>
<input class="peer hidden" type="checkbox" name="display-comments" id="display-comments">
<label for="display-comments" class="peer-checked:flex justify-end items-center hidden fixed w-full z-10 left-0 top-0 h-screen bg-white bg-opacity-25 backdrop-blur-sm">
</label>
<div id="comments-modal" class="peer-checked:flex flex-col px-4 pt-8 justify-start items-start animate-slidein hidden fixed top-0 right-0 z-[100] h-full w-full sm:max-w-2xl max-w-[90%] bg-white drop-shadow-lg">
    <button id="closeComments" onclick="{(e) => toggleComments(e)}" for="display-comments" class="absolute top-4 right-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
    </button>
    <div class="text-2xl">Comments</div>
    <div class="w-full flex items-center">
        <textarea name="" id="" class="w-full max-w-xl rounded-r-none p-1 rounded-md border border-gray-600 border-r-0 outline-none" rows="3"></textarea>
        <button class="h-full bg-white w-12 hover:bg-gray-100 rounded-r-md flex justify-center items-center border border-gray-600 border-l-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="stroke-black"><path d="m3 3 3 9-3 9 19-9Z"/><path d="M6 12h16"/></svg>
        </button>
    </div>
    <div class="flex flex-col w-full pr-4 gap-2 overflow-y-auto py-4">
        @for ($i = 0; $i < 12; $i++)
            <x-comment-single :user="'user'.$i" :message="'hablaré con mi abogado'" :isResponse="false" />
        @endfor
        <x-comment-single :user="'abogado'" :message="'Qué abogado?'" :isResponse="true" />
        <x-comment-single :user="'abogado'" :message="'El que tengo aquí colgado'" :isResponse="true" />
    </div>
</div>

<script>
    const input = document.getElementById("display-comments")
    console.log(input)

    const closeComments = document.getElementById("closeComments")

    closeComments.addEventListener("click", toggleComments)

    function toggleComments(e){
        console.log(e)
        e.preventDefault();
        e.stopPropagation();
        input.checked = false
    }
    //     const modal = document.getElementById("comments-modal")
    //     modal.classList.remove("animate-slidein")
    //     modal.classList.add("animate-slideout")
    //     setTimeout(() => {
    //         modal.classList.add("animate-slidein")
    //         modal.classList.add("animate-slideout")
    //         console.log("Delayed")
    //         console.log(modal.classList)
    //         input.checked = false
    //     }, 700);
    // }
</script>
