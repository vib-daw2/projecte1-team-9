@extends('layout')
<div class="w-full max-w-5xl mx-auto px-12 flex flex-col py-12 gap-4">
    <div class="flex justify-between">
        <div class="text-4xl font-bold">Users</div>
        <button
            class="w-28 py-2 rounded-md bg-white hover:bg-gray-100 ring-1 ring-black text-black font-medium flex justify-center items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-save">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                <polyline points="17 21 17 13 7 13 7 21" />
                <polyline points="7 3 7 8 15 8" />
            </svg>
            Save
        </button>
    </div>
    <div class="w-full flex justify-between items-center gap-3">
        <input type="search" name="search" id="search"
            class="ring-1 w-full max-w-lg rounded-md ring-black py-1 px-2">
        <button
            class="w-28 py-2 rounded-md bg-gray-900 hover:bg-gray-900/90 text-white font-medium flex justify-center items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-search">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
            </svg>
            Search
        </button>
    </div>
    @foreach ($users as $user)
        <div class="flex flex-row w-full h-36 bg-white border-b gap-3 justify-between items-center">
            <a href="/user/{{$user->id}}" class="w-full flex justify-start items-center gap-8 group">
                <div class="rounded-full bg-gray-900 text-white flex justify-center items-center w-20 h-20">
                    AA
                </div>
                <div>
                    <div class="text-xl font-bold group-hover:underline">{{$user->username}}</div>
                    <div class="text-sm group-hover:underline">{{$user->email}}</div>
                </div>
            </a>
            <div class="flex flex-col justify-center items-center gap-2">
                @if($user->id != auth()->user()->id)
                <a
                    href="/admin/users/{{$user->id}}/edit"
                    class="py-2 block relative group px-2 rounded-md text-black w-fit h-fit bg-white hover:bg-gray-100 border border-black hover:border-l-0 hover:rounded-l-none flex justify-between items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    <div class="group-hover:block hidden absolute right-10 w-24 py-2 text-center bg-gray-100 rounded-l-md border border-black border-r-0">Edit</div>
                </a>
                
                    <form action="/admin/users/{{$user->id}}/delete" method="POST">
                        @csrf
                        <button
                            class="py-2 px-2 group relative rounded-md text-white w-fit h-fit bg-red-500 hover:bg-red-500/90 hover:rounded-l-none flex justify-between items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-trash-2">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" x2="10" y1="11" y2="17" />
                                <line x1="14" x2="14" y1="11" y2="17" />
                            </svg>
                            <div class="group-hover:block hidden absolute right-10 w-24 py-2 bg-red-500/90 rounded-l-md">Delete</div>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
    <div class="mx-auto mt-4">
        {{ $users->onEachSide(2)->links('vendor.pagination.tailwind')}}
        </div>
</div>
