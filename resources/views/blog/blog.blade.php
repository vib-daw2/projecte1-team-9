@extends('layout')
<div class="w-full min-h-screen flex justify-start flex-col items-center px-12 pt-12">
    <div class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-start gap-3">
        <div class="w-full flex justify-between items-start py-2">
        <div class="text-5xl overflow-clip">{{ $blog->title }}</div>
        @if ($blog->status == "draft")
                <div class="rounded-md bg-gray-900 text-white px-2 py-1 w-fit font-medium text-sm">DRAFT</div>
            @endif
        </div>
        <div class="font-light text-lg py-2 max-w-3xl border-b w-full">
            {{ $blog->subtitle }}
        </div>
        <div class="flex flex-wrap items-center gap-2 justify-between w-full text-gray-600 py-2 border-b">
            <x-user-display username="{{ $blog->username }}" />
                <x-date-display timestamp="{{ $blog->created_at }}" />
                    <x-blog-like :liked="false" :likes="5" />
                </div>
                <div class="leading-1 text-lg font-light text-justify mt-4">
            @foreach(explode("\n", $blog->body) as $paragraph)
                <p class="py-2">{{ $paragraph }}</p>
            @endforeach
        </div>

    </div>
</div>
