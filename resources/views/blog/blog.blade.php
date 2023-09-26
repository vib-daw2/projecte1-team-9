@extends('layout')
<div class="w-full min-h-screen flex justify-start flex-col items-center px-12 py-8">
    <div class="max-w-3xl w-full mx-auto flex flex-col justify-start items-start gap-3">
        <div class="w-full flex justify-between items-start py-2">
        <div class="text-5xl">{{ $blog->title }}</div>
        <div class="flex flex-col gap-2 items-end">
            @if ($blog->status == "draft")
                <div class="rounded-md bg-gray-900 text-white px-2 py-1 w-fit font-medium text-sm">DRAFT</div>
            @endif
            @if (auth()->user()->id == $blog->userId)
            <a
            href="/blog/{{ $blog->id }}/edit"
            class="w-28 py-2 rounded-md bg-white hover:bg-gray-100 text-black font-medium flex justify-center items-center gap-2 ring-1 ring-black">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
            Edit
        </a>
            @endif
        </div>
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
