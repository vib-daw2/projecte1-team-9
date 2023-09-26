@extends('layout')
<div class="w-full flex justify-center items-center min-h-screen bg-gray-50 overflow-hidden">
    <div class="rounded-lg border h-fit shadow-lg w-full max-w-md p-8 bg-white">
        <div class="text-2xl font-medium">Log In</div>
        {{-- <div class="w-full mt-4 flex justify-between items-center gap-4">
            <div class="w-12 h-12 flex justify-center items-center rounded-md ring-1 ring-black">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-github"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
            </div>
        </div> --}}
        <form class="w-full mt-4 flex flex-col gap-4 " method="POST">
            @csrf
            <div class="w-full">
                <label class="block">Username</label>
                <input type="text" name="username" id="username" class="px-2 py-1 rounded-lg ring-1 ring-black w-full">
            </div>
            <div class="w-full">
                <label class="block">Password</label>
                <input type="password" name="password" id="password"
                    class="px-2 py-1 ring-black rounded-lg ring-1 w-full">
            </div>
            @error('username')
            <div>
                <div class="text-red-500 text-sm mt-1">{{$message}}</div>
            </div>
            @enderror
            <div class="flex justify-between items-center">
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="select-none">Remember me</label>
                </div>
                <a class="text-red-500 underline underline-offset-4 hover:text-red-600" href="#">Forgot my
                    password</a>
            </div>
            <input type="submit" value="Log In"
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
        <a href="/signup"
            class="w-full mt-4 block bg-white hover:bg-gray-50 font-medium text-black ring-1 ring-black py-2 rounded-lg text-center">Sign
            up</a>
    </div>
</div>
