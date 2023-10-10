@extends('layout')
@extends('layout')
<div class="w-full max-w-5xl mx-auto px-12 flex flex-col py-12 gap-4">
    <div class="flex justify-between">
        <div class="text-4xl font-bold">Edit User</div>
    </div>
    <form class="w-full flex flex-col gap-3" method="POST">
        @csrf
        <div>
            <label for="email" class="block">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}"
                class="w-full border-b-black outline-none border-b px-2 py-1">
        </div>
        @error('email')
            <div>
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            </div>
        @enderror
        <div>
            <label for="username" class="block">Username</label>
            <input type="text" name="username" id="username" value="{{ $user->username }}"
                class="w-full border-b-black outline-none border-b px-2 py-1">
        </div>
        @error('username')
            <div>
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            </div>
        @enderror
        <div>
            <label for="role" class="block">Role</label>
            <select defaultValue="{{ $user->role }}" name="role" id="role" required
                class="w-full border-b-black bg-white py-1 border-b outline-none">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Moderator</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        @if (Auth::user()->auth_provider == null)
            <div>
                <label for="password" class="block">Admin Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border-b-black outline-none border-b px-2 py-1">
            </div>
            @error('password')
                <div>
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                </div>
            @endif
        @enderror
        <div class="w-full flex justify-end">

            <button
                class="w-28 py-2 rounded-md bg-gray-900 hover:bg-gray-900/90 text-white font-medium flex justify-center items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-save">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Save
            </button>
    </form>
</div>
</div>
