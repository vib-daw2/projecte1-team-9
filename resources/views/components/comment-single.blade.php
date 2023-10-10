<div id="comment_{{ $comment->id }}"
    class="comment @if ($isResponse) w-[calc(100%-4rem)] ml-[4rem] @else w-full mb-3 drop-shadow-lg shadow-black @endif relative px-2 gap-3 py-2 rounded-md flex flex-row justify-start items-start hover:bg-gray-100 bg-gray-50">
    @if ($isResponse)
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="48" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-corner-down-right">
            <polyline points="15 10 20 15 15 20" />
            <path d="M4 4v7a4 4 0 0 0 4 4h12" />
        </svg>
    @endif
    @if(isset($comment->user->profile_picture) & ($comment->user->profile_picture != null))
    <div class="w-8 h-8 bg-black rounded-full text-white flex justify-center items-center">
        <img src="{{asset("storage/".$comment->user->profile_picture)}}" alt="{{strtoupper($comment->user->username[0])}}" class="object-fit rounded-full w-full h-full">
    </div>
    @else
    <div class="w-8 h-8 bg-black flex justify-center items-center text-white rounded-full">
        {{strtoupper($comment->user->username[0])}}
    </div>
    @endif
    <div class="w-fit ml-4">
        <div class="font-semibold">@ {{ $comment->user->username }}</div>
        <div class="mt-2">{{ $comment->body }}</div>
    </div>
    @auth
    @if (!$isResponse)
        <button id="answer_{{ $comment->id }}" onclick="selectParent({{ $comment->id }}, '{{ $comment->user->username }}')"
            class="w-fit absolute bottom-1 right-1 p-1 rounded-md hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-reply rotate-180">
                <polyline points="9 17 4 12 9 7" />
                <path d="M20 18v-2a4 4 0 0 0-4-4H4" />
            </svg>
        </button>
        @endif
    @if ($comment->user->id == Auth::id() || Auth::user()->role == 'admin' || Auth::user()->role == 'mod')
        <form action="/comment/{{$comment->id}}/delete" method="POST">
            @csrf
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <button class="p-1 absolute top-1 right-1 rounded-md hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-trash-2 stroke-red-600 group">
                    <path d="M3 6h18" />
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                    <line x1="10" x2="10" y1="11" y2="17" />
                    <line x1="14" x2="14" y1="11" y2="17" />
                </svg>
            </button>
        </form>
    
    @endif
    @endauth
</div>

<script>
    function selectParent(id, user) {
        const parentId = document.querySelector("input[name=parent_id]")
        const comments = document.querySelectorAll(".comment")
        comments.forEach(comment => {
            // comment.classList.remove("border-2", "border-black")
            comment.classList.add("opacity-30")
        })
        const comment = document.querySelector(".comment#comment_" + id)
        // comment.classList.toggle("border-2")
        // comment.classList.toggle("border-black")
        comment.classList.toggle("opacity-30")
        parentId.value = id
        document.querySelector("textarea").focus()

        const parentMark = document.getElementById("has-parent")
        parentMark.classList.add("flex")
        parentMark.classList.remove("hidden")

        const respondsTo = document.getElementById("responds-to")
        respondsTo.innerText = "@" + user

        // Scroll to comment
        comment.scrollIntoView({
            behavior: "smooth",
            block: "start",
            inline: "nearest"
        });
    }
</script>
