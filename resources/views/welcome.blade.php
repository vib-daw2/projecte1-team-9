@extends('layout')
<div class="w-full min-h-screen bg-gray-50 flex justify-center flex-col items-start p-12">
    <div class="max-w-3xl w-full mx-auto flex flex-col justify-start items-center gap-3">
        @for ($i = 0; $i < 5; $i++)
            <x-postlist :username="sprintf('User %d', $i)" :title="sprintf('Post %d', $i)" :id="$i" />
        @endfor
    </div>
</div>
