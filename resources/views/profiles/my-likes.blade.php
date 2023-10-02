@extends('layout')
<div class="w-full min-h-screen flex justify-start flex-col items-center px-12 py-8">
    <div class="max-w-5xl w-full mx-auto h-fit flex flex-col justify-start items-start gap-3">
        <x-profiletabs selected="likes"/>
        <div class="flex flex-col items-center w-full h-fit justify-between mt-4 gap-4">
            <x-profilestats :username="$username" />
            <div class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-center gap-3">
                @foreach ($blogs as $blog)
                <x-postlist :username="$blog->username"
                            :title="$blog->title"
                            :id="$blog->id"
                            :subtitle="$blog->subtitle"
                            :ownerid="$blog->owner_id"
                            :liked="$blog->liked ?? ''"
                            :likes="$blog->likes ?? 0"
                            :dislikes="$blog->dislikes ?? 0"
                />
                @endforeach
            </div>
            <div class="mx-auto mt-4">
                {{ $blogs->onEachSide(2)->links('vendor.pagination.tailwind')}}
            </div>
        </div>
    </div>
</div>
