@extends('layout')
<div class="w-full max-w-5xl mx-auto px-12 flex flex-col py-12 gap-4">
    <div class="flex justify-between w-full">
        <div class="text-4xl font-bold">Users</div>
    </div>
    <form class="w-full flex justify-center items-center gap-3 relative" method="GET">
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
    @foreach ($users as $user)
        <x-user-admin-panel :user="$user" />
    @endforeach
    <div class="mx-auto mt-4">
        {{ $users->onEachSide(2)->links('vendor.pagination.tailwind') }}
    </div>
</div>
