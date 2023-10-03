@extends('layout')
<div class="w-full min-h-screen bg-gray-50 flex justify-center flex-col items-start px-12 py-8">
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
