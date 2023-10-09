@extends('layout')
<div class="w-full min-h-screen bg-white flex justify-center flex-row items-start px-12 py-8">
    <div class="w-full max-w-5xl flex flex-col justify-center items-center">
        <form class="w-full flex justify-center items-center gap-3 relative">
            <svg class="absolute top-2 left-1 lucide lucide-search" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
            </svg>
            <input value="{{ request('s') }}" placeholder="Search..." type="search" name="s" id="s"
            class="w-full bg-white outline-none border-b border-b-black pl-8 py-2">
            <button class="bg-gray-900 w-32 py-2 rounded-md text-white">Search</button>
        </form>
        @if(request('s'))
        <div class="w-full rounded-md flex justify-center items-center">
            <input data-ui="posts" type="radio" name="show" id="posts" class="hidden peer/posts">
            <input data-ui="users" type="radio" name="show" id="users" class="hidden peer/users">
            <label for="posts" onclick="showPosts()"
            class="w-1/2 text-center py-1 peer-checked/posts:bg-gray-900 hover:bg-gray-200 rounded-l-md checked:text-white peer-checked/posts:text-white font-medium">
                    <span>{{count($blogs)}}</span>
                Posts
            </label>
            <label for="users" onclick="showUsers()"
            class="w-1/2 text-center py-1 hover:bg-gray-200 peer-checked/users:bg-gray-900 peer-checked/users:text-white cursor-pointer font-medium rounded-r-md">
                <span>{{count($users)}}</span>
                Users
            </label>
        </div>
        <div class="w-full flex flex-col justify-start items-center" id="postlist">
            @if($blogs->count() == 0)
                <div class="max-w-5xl w-full flex justify-center mt-4 mx-auto font-semibold text-2xl">No blogs found matching this criteria</div>
            @endif
            <div
            class="max-w-5xl mt-4 w-full mx-auto data-[ui=posts]:checked:flex data-[ui=users]:checked:hidden flex-col justify-start items-center gap-3">
                @foreach ($blogs as $blog)
                    <x-postlist :username="$blog->username" :title="$blog->title" :id="$blog->id" :subtitle="$blog->subtitle"
                        :ownerid="$blog->user_id" :liked="''" :likes="0" :dislikes="0" />
                @endforeach
            </div>
        </div>
        <div id="userlist"
        class="max-w-5xl mt-4 w-full mx-auto hidden flex-col justify-start items-center gap-3">
        @if ($users->count() == 0)
        <div class="max-w-5xl w-full flex justify-center mx-auto font-semibold text-2xl">No users found matching this criteria</div>
        @endif
            @foreach ($users as $user)
                    <div class="flex flex-row justify-between items-center w-full gap-8 border-b border-b-black p-4">
                        <div class="flex flex-row items-center gap-3 max-w-xs w-full">
                            <div class="w-16 h-16 rounded-full flex justify-center items-center bg-gray-900">
                                @if(isset($user->profile_picture))
                                <img src="{{asset("storage/".$user->profile_picture)}}" alt="{{strtoupper($user->username[0])}}" class="object-fit rounded-full w-full h-full m-auto">
                                @else
                                {{ strtoupper($user->username)[0] }}
                                @endif
                            </div>
                            <a href="/user/{{$user->id}}" class="text-lg block font-medium">{{ $user->username }}</a>
                        </div>
                        <div class="flex justify-start gap-6 items-center flex-wrap w-full max-w-md">
                        <div class="text-left">{{ $user->followers }} Followers</div>
                        <div class="text-left">{{ $user->follows }} Following</div>
                        </div>
                        @auth
                        @if(Auth::id() != $user->id)
                        <form method="POST" action="/follow/{{$user->id}}"
                            class="flex flex-row gap-2 w-1/3 items-center justify-center">
                          @csrf
                          @php
                              $following = DB::table('follows')
                                ->select('follows.*')
                                ->where('follows.follower_id', '=', Auth::id())
                                ->where('follows.followee_id', '=', $user->id)
                                ->first();
                          @endphp
                            @if($following)
                            <button class="w-36 group font-medium flex justify-center items-center px-2 gap-2 py-1 bg-gray-900 text-white hover:bg-red-600 rounded-md">
                                <svg class="group-hover:hidden block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-check-2"><path d="M14 19a6 6 0 0 0-12 0"/><circle cx="8" cy="9" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
                                <span class="group-hover:hidden block">Following</span>
                                <svg class="group-hover:block hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-x-2"><path d="M14 19a6 6 0 0 0-12 0"/><circle cx="8" cy="9" r="4"/><line x1="17" x2="22" y1="8" y2="13"/><line x1="22" x2="17" y1="8" y2="13"/></svg>
                                <span class="group-hover:block hidden">Unfollow</span>
                            </button>
                            @else
                            <button class="w-36 font-medium flex justify-center items-center px-2 gap-2 py-1 bg-white hover:bg-gray-200 ring-1 ring-black rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus-2"><path d="M14 19a6 6 0 0 0-12 0"/><circle cx="8" cy="9" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                Follow
                            </button>
                        </form>
                        @endif
                        @else
                        <div class="w-36"></div>
                        @endif
                        @endauth
                </div>
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
