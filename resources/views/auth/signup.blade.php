@extends('layout')
<div class="w-full flex justify-center items-center min-h-screen bg-gray-50 overflow-hidden">
    <div class="w-full flex justify-center items-start drop-shadow-lg">
        <x-external-auth />
        <div class="rounded-lg border h-fit w-full max-w-md p-8 bg-white rounded-tl-none">
        <div class="text-2xl font-medium">Sign Up</div>
        <form class="w-full mt-8 flex flex-col gap-4 " method="POST">
            @csrf
            <div class="w-full">
                <label class="block">Username</label>
                <input type="text" value="{{ old('username') }}" name="username" id="username"
                    class="px-2 py-1 @error('username') ring-red-500 @else ring-black @enderror rounded-lg ring-1 w-full">
                @error('username')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full">
                <label class="block">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" id="email"
                    class="px-2 py-1 @error('email') ring-red-500 @else ring-black @enderror rounded-lg ring-1 w-full">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full">
                <label class="block">Password</label>
                <input type="password" name="password1" id="password1"
                    class="px-2 py-1 @error('password1') ring-red-500 @else ring-black @enderror rounded-lg ring-1 w-full">
                @error('password1')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full">
                <label class="block">Repeat Password</label>
                <input type="password" name="password2" id="password2"
                    class="px-2 py-1 @error('password2') ring-red-500 @else ring-black @enderror rounded-lg ring-1 w-full">
                @error('password2')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="Sign Up"
                class="w-full bg-gray-900 hover:bg-gray-900/90 font-medium text-white py-2 rounded-lg">
        </form>
        <div class="w-full h-4 mt-4 flex justify-center items-center">
            <div class="w-5/12">
                <div class="h-1/2 border-b"></div>
            </div>
            <div class="w-2/12 text-center">or</div>
            <div class="w-5/12">
                <div class="h-1/2 border-b"></div>
            </div>
        </div>
        <a href="/login"
            class="w-full mt-4 block bg-white hover:bg-gray-50 font-medium text-black ring-1 ring-black py-2 rounded-lg text-center">Log
            in</a>
    </div>
    </div>
</div>
