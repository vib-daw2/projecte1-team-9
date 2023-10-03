@extends('layout')
<div class="w-full min-h-screen bg-gray-50 flex justify-center flex-row items-start px-12 py-8">
    <div class="w-full max-w-5xl flex flex-col justify-center items-center">
        <form class="w-full flex justify-center items-center gap-3 relative">
            <svg class="absolute top-2 left-1 lucide lucide-search" xmlns="http://www.w3.org/2000/svg" width="24"
                 height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.3-4.3"/>
            </svg>
            <input value="{{ request('s') }}" placeholder="Search..." type="search" name="s" id="s"
                   class="w-full bg-gray-50 outline-none border-b border-b-black pl-8 py-2">
            <button class="bg-gray-900 w-32 py-2 rounded-md text-white">Search</button>
        </form>
        <div id="userlist"
             class="max-w-5xl mt-4 w-full mx-auto flex-col justify-start items-center gap-3">
            @foreach ($users as $user)
            <div class="flex flex-row justify-between items-baseline w-full gap-8 border-b border-b-black p-4">
                {{-- <img src="" alt="{{ $user->username }}" class="w-16 h-16 rounded-full"> --}}
                <div class="flex flex-row items-center gap-3 max-w-xs w-full">
                    <div class="w-16 h-16 rounded-full flex justify-center items-center bg-gray-900">
                        {{ strtoupper($user->username)[0] }}
                    </div>
                    <a href="/user/{{$user->id}}" class="text-lg block font-medium">{{ $user->username }}</a>
                </div>
                <div class="flex justify-start gap-6 items-center flex-wrap w-full max-w-md">
                    <div class="text-left">{{ $user->followers }} Followers</div>
                    <div class="text-left">{{ $user->follows }} Following</div>
                    {{--
                    <div class="text-left">{{$user->posts}} Posts</div>
                    --}}
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
                    <button
                        class="w-36 group font-medium flex justify-center items-center px-2 gap-2 py-1 bg-gray-900 text-white hover:bg-red-600 rounded-md">
                        <svg class="group-hover:hidden block lucide lucide-user-check-2"
                             xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 19a6 6 0 0 0-12 0"/>
                            <circle cx="8" cy="9" r="4"/>
                            <polyline points="16 11 18 13 22 9"/>
                        </svg>
                        <span class="group-hover:hidden block">Following</span>
                        <svg class="group-hover:block hidden lucide lucide-user-x-2" xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 19a6 6 0 0 0-12 0"/>
                            <circle cx="8" cy="9" r="4"/>
                            <line x1="17" x2="22" y1="8" y2="13"/>
                            <line x1="22" x2="17" y1="8" y2="13"/>
                        </svg>
                        <span class="group-hover:block hidden">Unfollow</span>
                    </button>
                    @else
                    <button
                        class="w-36 font-medium flex justify-center items-center px-2 gap-2 py-1 bg-white hover:bg-gray-200 ring-1 ring-black rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-user-plus-2">
                            <path d="M14 19a6 6 0 0 0-12 0"/>
                            <circle cx="8" cy="9" r="4"/>
                            <line x1="19" x2="19" y1="8" y2="14"/>
                            <line x1="22" x2="16" y1="11" y2="11"/>
                        </svg>
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
    </div>
</div>
