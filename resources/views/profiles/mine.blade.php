@extends('layout')
<div class="w-full min-h-screen flex justify-start flex-col items-center py-8">
    <div class="max-w-5xl w-full mx-auto h-fit flex flex-col justify-start items-start gap-3">
        <x-profiletabs selected="profile" />
        <div class="flex flex-col w-full h-fit justify-center items-center mt-4 gap-4">
            <x-profilestats />
            <form class="flex flex-col gap-3 w-2/3 pt-6 max-w-3xl" method="POST">
                @csrf
                <div class="w-full">
                    <label class="block">Username</label>
                    <input type="text" name="username" id="username"
                        class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
                </div>
                <div class="w-full">
                    <label class="block">Email</label>
                    <input type="email" name="email" id="email"
                        class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
                </div>
                <div class="w-full">
                    <label class="block">Password</label>
                    <input type="password" name="password1" id="password1"
                        class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
                </div>
                <div class="w-full flex justify-end gap-3">
                    <a href="/me/password"
                        class="w-28 min-w-fit px-2 py-2 rounded-md bg-white hover:bg-gray-100 ring-1 ring-black text-black font-medium flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-key-round">
                            <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z" />
                            <circle cx="16.5" cy="7.5" r=".5" />
                        </svg>
                        Change Password
                    </a>
                    <button
                        class="w-28 py-2 rounded-md bg-gray-900 hover:bg-gray-900/90 text-white font-medium flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-save">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
