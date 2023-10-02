@extends('layout')
<div class="max-w-5xl py-8 w-full mx-auto h-fit flex flex-col justify-start items-start gap-3">

    <div class="flex flex-col items-center w-full h-fit justify-between gap-4">
        <x-profilestats :username="$username"/>
        @auth
        <div class="font-base text-lg px-4 flex flex-row gap-2 w-full justify-between">
            <div class="mt-4 font-base text-lg px-4 flex flex-row gap-2 w-full justify-center">
                <div class="py-1 w-1/3 text-center">{{$followers}}/{{$follows}}
                    <span>Followers/Following</span>
                </div>
                <div class="py-1 w-1/3 text-center">
                    <form method="POST" action="/follow/{{$id}}"
                          class="flex flex-row gap-2 items-center justify-center hover:underline">
                        @csrf
                        @if ($following)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-user-check-2">
                            <path d="M14 19a6 6 0 0 0-12 0"/>
                            <circle cx="8" cy="9" r="4"/>
                            <polyline points="16 11 18 13 22 9"/>
                        </svg>
                        <button type="submit">
                            Following
                        </button>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-user-plus-2">
                            <path d="M14 19a6 6 0 0 0-12 0"/>
                            <circle cx="8" cy="9" r="4"/>
                            <line x1="19" x2="19" y1="8" y2="14"/>
                            <line x1="22" x2="16" y1="11" y2="11"/>
                        </svg>
                        <button type="submit">
                            Follow
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        @endauth
        <div class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-center gap-3">
            @foreach ($blogs as $blog)
            <x-postlist :username="$blog->username"
                        :title="$blog->title"
                        :id="$blog->id"
                        :subtitle="$blog->subtitle"
                        :ownerid="$blog->owner_id"
                        :liked="$blog->liked ?? ''"
                        :likes="$blog->likes ?? 0"
                        :dislikes="$blog->dislikes ?? 0"
            />
            @endforeach
        </div>
        <div class="mx-auto mt-4">
            {{ $blogs->onEachSide(2)->links('vendor.pagination.tailwind')}}
        </div>
    </div>
</div>
