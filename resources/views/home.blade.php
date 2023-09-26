@extends('layout')
<div class="w-full min-h-screen bg-gray-50 flex justify-center flex-col items-start p-12">
    <div class="max-w-3xl w-full mx-auto flex flex-col justify-start items-center gap-3">
        @foreach ($blogs as $blog)
            <x-postlist :username="$blog->username"
                        :title="$blog->title"
                        :id="$blog->id"
                        :subtitle="$blog->subtitle"
                        :ownerid="$blog->owner_id"
            />
        @endforeach
    </div>
</div>
