@extends('layout')
<div class="max-w-5xl py-8 w-full mx-auto h-fit flex flex-col justify-start items-start gap-3">

    <div class="flex flex-col items-center w-full h-fit justify-between gap-4">
        <x-profilestats :username="$username" :posts="4" :likes="$likes" />
        <div class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-center gap-3">
            @foreach ($blogs as $blog)
            <x-postlist :username="$blog->username"
                        :title="$blog->title"
                        :id="$blog->id"
                        :subtitle="$blog->subtitle"
                        :ownerid="$blog->owner_id"
                        :liked="$blog->liked ?? ''"
            />
            @endforeach
        </div>
        <div class="mx-auto mt-4">
            {{ $blogs->onEachSide(2)->links('vendor.pagination.tailwind')}}
        </div>
    </div>
</div>
