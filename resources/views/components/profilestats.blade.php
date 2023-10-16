@php
    use App\Models\User;
    $user = User::where('username', '=', $username)->first();
    $stats = $user->getProfileStats();
    $following = DB::table('follows')
        ->select('follows.*')
        ->where('follows.follower_id', '=', Auth::id())
        ->where('follows.followee_id', '=', $user->id)
        ->first();
@endphp

<div class="w-full h-full pb-4 border-b border-b-black">
    @if (isset($user->profile_picture) & ($user->profile_picture != null))
        <div class="w-36 h-36 bg-black rounded-full text-white mx-auto flex justify-center items-center">
            @if (($user->auth_provider != 'google') & ($user->auth_provider != 'github'))
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ strtoupper($username[0]) }}"
                    class="object-fit rounded-full w-full h-full">
            @else
                <img src="{{ $user->profile_picture }}" alt="{{ strtoupper($username[0]) }}"
                    class="object-fit rounded-full w-full h-full">
            @endif
        </div>
    @else
        <div class="w-36 h-36 mx-auto bg-black flex justify-center items-center text-white text-4xl rounded-full">
            {{ strtoupper($username[0]) }}
        </div>
    @endif
    <div class="font-medium mt-4 text-center text-lg">{{ '@' . $username }}</div>
    <div class="mt-4 font-base text-lg px-4 flex flex-row gap-2 w-full justify-between">
        <div class="py-1 w-1/3 text-center"><b>{{ $stats->likes }}</b> Likes</div>
        <div class="py-1 w-1/3 text-center"><b>{{ $stats->posts_count }}</b> Posts</div>
        @php
            $up_since = getDate(strtotime($stats->up_since));
        @endphp
        <div class="py-1 w-1/3 text-center">Up since: <b>{{ $up_since['month'] }} {{ $up_since['year'] }}</b></div>
    </div>
    <div class="mt-4 flex justify-between w-full gap-2 px-4 text-lg font-base">
        <div class="w-1/3 text-center">{{ $stats->followers }} Followers</div>
        <div class="w-1/3 text-center">
            <a href="/me/following" class="hover:underline">{{ $stats->follows }} Following</a>
        </div>
        @guest
            <div class="w-1/3"></div>
        @endguest
        @auth
            @if (Auth::id() != $user->id)
                <form method="POST" action="/follow/{{ $user->id }}"
                    class="flex flex-row gap-2 w-1/3 items-center justify-center">
                    @csrf
                    @if ($following)
                        <button
                            class="w-36 group font-medium flex justify-center items-center px-2 gap-2 py-1 bg-gray-900 text-white hover:bg-red-600 rounded-md">
                            <svg class="group-hover:hidden block" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 19a6 6 0 0 0-12 0" />
                                <circle cx="8" cy="9" r="4" />
                                <polyline points="16 11 18 13 22 9" />
                            </svg>
                            <span class="group-hover:hidden block">Following</span>
                            <svg class="group-hover:block hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
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
                    @endif
                </form>
            @endauth
        @endif
    </div>
</div>
