@extends('layout')
@php
    // dd($comments);
@endphp
<div class="w-full min-h-screen flex justify-start flex-col items-center px-12 py-8">
    <div class="max-w-5xl w-full mx-auto flex flex-col justify-start items-start gap-3">
        <div class="w-full flex justify-between items-start py-2">
            <div class="text-5xl">{{ $blog->title }}</div>
            <div class="flex flex-col gap-2 items-end">
                @if ($blog->status == 'draft')
                    <div class="rounded-md bg-gray-900 text-white px-2 py-1 w-fit font-medium text-sm">DRAFT</div>
                @endif
                @if (auth()->user() && auth()->user()->id == $blog->userId)
                    <a href="/blog/{{ $blog->id }}/edit"
                        class="w-28 py-2 rounded-md bg-white hover:bg-gray-100 text-black font-medium flex justify-center items-center gap-2 ring-1 ring-black">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-pencil">
                            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                            <path d="m15 5 4 4" />
                        </svg>
                        Edit
                    </a>
                @endif
                @if (auth()->user() && (auth()->user()->id == $blog->userId || auth()->user()->role == 'admin'))
                    <button onclick="deletePost(event, {{ $blog->id }})"
                        class="w-28 py-2 rounded-md bg-red-600 hover:bg-red-600/90 text-white font-medium flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-trash-2">
                            <path d="M3 6h18" />
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                            <line x1="10" x2="10" y1="11" y2="17" />
                            <line x1="14" x2="14" y1="11" y2="17" />
                        </svg>
                        Delete
                    </button>
                @endif
            </div>
        </div>

        <div class="font-light text-lg py-2 max-w-5xl border-b w-full">
            {{ $blog->subtitle }}
        </div>

        <div class="flex flex-wrap items-center gap-2 justify-between w-full text-gray-600 py-2 border-b">
            <x-user-display :username="$blog->username" :id="$blog->userId" />
            <x-date-display timestamp="{{ $blog->created_at->format('d-m-Y H:i') }}" />
            <x-views-display :views="$blog->views" />
            <x-blog-like :liked="$liked ?? ''" :dislikes="$dislikes ?? 0" :likes="$likes ?? 0" :id="$blog->id" :responsive="false" />
            <x-comments :comments="$comments" />
        </div>
        @if (isset($blog->picture))
            {{-- <div class="w-full h-72 pb-4 border-b object-left-top relative group">
                <img src="{{ asset('storage/' . $blog->picture) }}" alt="{{ $blog->title }}"
                    class="object-cover object-left-top rounded-md w-full h-full">

            </div> --}}
            <x-blog-picture :src="asset('storage/' . $blog->picture)" :alt="$blog->title" />
        @endif
        <div id="body"
            class="leading-1 w-full text-lg font-light text-justify mt-4 [&>h1]:font-semibold [&>h1]:text-2xl [&>h1]:mt-4 [&>h1]:mb-2 [&>h1]:w-full [&>h1]:border-b">
            {!! $blog->body !!}

        </div>

    </div>
</div>
