<div class="flex flex-row justify-between items-center w-full gap-8 border-b border-b-black p-4">
    <div class="flex flex-row items-center gap-3 max-w-xs w-full">
        <div class="w-16 h-16 rounded-full flex justify-center items-center bg-gray-900">
            @if (isset($user->profile_picture))
                @if ($user->auth_provider == 'google' || $user->auth_provider == 'github')
                    <img src="{{ $user->profile_picture }}" alt="{{ strtoupper($user->username[0]) }}"
                        class="object-fit rounded-full w-full h-full m-auto">
                @else
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ strtoupper($user->username[0]) }}"
                        class="object-fit rounded-full w-full h-full m-auto">
                @endif
            @else
                {{ strtoupper($user->username)[0] }}
            @endif
        </div>
        <a href="/user/{{ $user->id }}" class="text-lg block font-medium">{{ $user->username }}</a>
    </div>
    <div class="flex justify-start gap-6 items-center flex-wrap w-full max-w-md">
        <div class="text-left">{{ $user->followers }} Followers</div>
        <div class="text-left">{{ $user->follows }} Following</div>
    </div>
    @auth
        @if (Auth::id() != $user->id)
            <form method="POST" action="/follow/{{ $user->id }}"
                class="flex flex-row gap-2 w-1/3 items-center justify-center">
                @csrf
                @php
                    $following = DB::table('follows')
                        ->select('follows.*')
                        ->where('follows.follower_id', '=', Auth::id())
                        ->where('follows.followee_id', '=', $user->id)
                        ->first();
                @endphp
                @if ($following)
                    <button
                        class="w-36 group font-medium flex justify-center items-center px-2 gap-2 py-1 bg-gray-900 text-white hover:bg-red-600 rounded-md">
                        <svg class="group-hover:hidden block" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-check-2">
                            <path d="M14 19a6 6 0 0 0-12 0" />
                            <circle cx="8" cy="9" r="4" />
                            <polyline points="16 11 18 13 22 9" />
                        </svg>
                        <span class="group-hover:hidden block">Following</span>
                        <svg class="group-hover:block hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-x-2">
                            <path d="M14 19a6 6 0 0 0-12 0" />
                            <circle cx="8" cy="9" r="4" />
                            <line x1="17" x2="22" y1="8" y2="13" />
                            <line x1="22" x2="17" y1="8" y2="13" />
                        </svg>
                        <span class="group-hover:block hidden">Unfollow</span>
                    </button>
                @else
                    <button
                        class="w-36 font-medium flex justify-center items-center px-2 gap-2 py-1 bg-white hover:bg-gray-200 ring-1 ring-black rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user-plus-2">
                            <path d="M14 19a6 6 0 0 0-12 0" />
                            <circle cx="8" cy="9" r="4" />
                            <line x1="19" x2="19" y1="8" y2="14" />
                            <line x1="22" x2="16" y1="11" y2="11" />
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
