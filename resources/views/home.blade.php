@extends('layout')

<div class="w-full min-h-screen bg-gray-50 flex justify-center flex-col items-start px-12 py-8">

    <div class="max-w-5xl w-full mx-auto flex flex-col justify-start items-center gap-3">
        <form class="w-full flex justify-center items-center gap-3 relative" method="GET" action="/search">
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
        @foreach ($blogs as $blog)
            <x-postlist :username="$blog->username" :title="$blog->title" :id="$blog->id" :subtitle="$blog->subtitle" :ownerid="$blog->owner_id"
                :liked="$blog->liked ?? ''" :likes="$blog->likes ?? 0" :dislikes="$blog->dislikes ?? 0" />
        @endforeach
    </div>
    <div class="mx-auto mt-4">
        {{ $blogs->onEachSide(2)->links('vendor.pagination.tailwind') }}
    </div>
</div>
