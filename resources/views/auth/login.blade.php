@extends('layout')
<div class="w-full flex justify-center items-center min-h-screen bg-gray-50 overflow-hidden">
    <div class="w-full flex justify-center items-start drop-shadow-lg">
        <x-external-auth />
        <div class="rounded-lg h-fit w-full max-w-md p-8 bg-white border rounded-tl-none">
            <div class="text-2xl font-medium">Log In</div>
            <form class="w-full mt-4 flex flex-col gap-4 " method="POST">
                @csrf
                <div class="w-full">
                    <label class="block">Username</label>
                    <input type="text" name="username" id="username"
                        class="px-2 py-1 rounded-lg ring-1 ring-black w-full">
                </div>
                <div class="w-full">
                    <label class="block">Password</label>
                    <input type="password" name="password" id="password"
                        class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
                </div>
                @error('username')
                    <div>
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    </div>
                @enderror
                <div class="flex justify-between items-center">
                    <div>
                        <input type="checkbox" name="remember" id="remember" class="cursor-pointer">
                        <label for="remember" class="select-none cursor-pointer">Remember me</label>
                    </div>
                    <a class="text-red-500 underline underline-offset-4 hover:text-red-600" href="#">Forgot my
                        password</a>
                </div>
                <input type="submit" value="Log In"
                    class="w-full bg-gray-900 hover:bg-gray-900/90 font-medium text-white py-2 rounded-lg cursor-pointer">
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
            <a href="/signup"
                class="w-full mt-4 block bg-white hover:bg-gray-50 font-medium text-black ring-1 ring-black py-2 rounded-lg text-center">Sign
                up</a>
        </div>
    </div>
</div>
