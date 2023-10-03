@extends('layout')
<div class="w-full min-h-screen bg-gray-50 flex justify-center flex-row items-start px-12 py-8">
    <div class="w-3/5 flex flex-col justify-center items-center">
        <div class="max-w-3xl w-full mx-auto flex flex-col justify-start items-center gap-3">
            @foreach ($blogs as $blog)
            <x-postlist :username="$blog->username"
                        :title="$blog->title"
                        :id="$blog->id"
                        :subtitle="$blog->subtitle"
                        :ownerid="$blog->user_id"
                        :liked="''"
                        :likes="0"
                        :dislikes="0"
            />
            @endforeach
        </div>
        <div class="mx-auto mt-4">
            {{ $blogs->onEachSide(2)->links('vendor.pagination.tailwind')}}
        </div>
    </div>
    <div>
        @foreach ($users as $user)
        <div class="w-64 p-4">
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-col w-1/3 justify-center items-center">
                    <!--TODO Aqui debajo va el circulito con la foto de perfil-->
                    <img src="" alt="{{ $user->username }}" class="w-16 h-16 rounded-full">
                    <span class="text-sm text-gray-500">{{ $user->username }}</span>
                </div>
                <div class="flex flex-col w-2/3 justify-center items-center">
                    <span class="text-sm text-gray-500">Followers {{ $user->followers }}</span>
                    <span class="text-sm text-gray-500">Following {{ $user->follows }}</span>

                </div>
            </div>
            <div class="flex flex-row justify-center items-center mt-4">
            </div>
        </div>
        @endforeach
    </div>
</div>

