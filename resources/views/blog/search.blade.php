@extends('layout')
<div class="w-full min-h-screen bg-white flex justify-center flex-row items-start px-12 py-8">
    <div class="w-full max-w-5xl flex flex-col justify-center items-center">
        <form class="w-full flex justify-center items-center gap-3 relative">
            <svg class="absolute top-2 left-1 lucide lucide-search" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
            </svg>
            <input value="{{ request('s') }}" placeholder="Search..." type="search" name="s" id="s"
                class="w-full bg-white outline-none border-b border-b-black pl-8 py-2">
            <button class="bg-gray-900 w-32 py-2 rounded-md text-white">Search</button>
        </form>
        @if (request('s'))
            <div class="w-full rounded-md flex justify-center items-center">
                <input data-ui="posts" type="radio" name="show" id="posts" class="hidden peer/posts">
                <input data-ui="users" type="radio" name="show" id="users" class="hidden peer/users">
                <label for="posts" onclick="showPosts()"
                    class="w-1/2 text-center py-1 peer-checked/posts:bg-gray-900 hover:bg-gray-200 rounded-l-md checked:text-white peer-checked/posts:text-white font-medium">
                    <span>{{ count($blogs) }}</span>
                    Posts
                </label>
                <label for="users" onclick="showUsers()"
                    class="w-1/2 text-center py-1 hover:bg-gray-200 peer-checked/users:bg-gray-900 peer-checked/users:text-white cursor-pointer font-medium rounded-r-md">
                    <span>{{ count($users) }}</span>
                    Users
                </label>
            </div>
            <div class="w-full flex flex-col justify-start items-center" id="postlist">
                @if ($blogs->count() == 0)
                    <div class="max-w-5xl w-full flex justify-center mt-4 mx-auto font-semibold text-2xl">No blogs found
                        matching this criteria</div>
                @endif
                <div
                    class="max-w-5xl mt-4 w-full mx-auto data-[ui=posts]:checked:flex data-[ui=users]:checked:hidden flex-col justify-start items-center gap-3">
                    @foreach ($blogs as $blog)
                        <x-postlist :username="$blog->username" :title="$blog->title" :id="$blog->id" :subtitle="$blog->subtitle"
                            :ownerid="$blog->user_id" :liked="''" :likes="0" :dislikes="0" />
                    @endforeach
                </div>
            </div>
            <div id="userlist" class="max-w-5xl mt-4 w-full mx-auto hidden flex-col justify-start items-center gap-3">
                @if ($users->count() == 0)
                    <div class="max-w-5xl w-full flex justify-center mx-auto font-semibold text-2xl">No users found
                        matching this criteria</div>
                @endif
                @foreach ($users as $user)
                    <x-search-user :user="$user" />
                @endforeach
            </div>
        @endif
    </div>
</div>
</div>

<script>
    document.getElementById("posts").checked = true
    document.getElementById("users").checked = false
    showPosts()

    function showPosts() {
        const postContainer = document.getElementById("postlist")
        const userContainer = document.getElementById("userlist")

        postContainer.classList.remove("hidden")
        postContainer.classList.add("flex")

        userContainer.classList.remove("flex")
        userContainer.classList.add("hidden")
    }

    function showUsers() {
        const postContainer = document.getElementById("postlist")
        const userContainer = document.getElementById("userlist")

        postContainer.classList.remove("flex")
        postContainer.classList.add("hidden")

        userContainer.classList.remove("hidden")
        userContainer.classList.add("flex")
    }
</script>
