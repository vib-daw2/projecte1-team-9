@extends('layout')

<div class="w-full min-h-screen flex justify-start flex-col items-center px-12 py-8">
    <form class="max-w-5xl w-full mx-auto flex flex-col justify-start items-center gap-3" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="w-full flex justify-between flex-wrap items-center">
            <input type="hidden" name="status" id="status" value="{{ $blog->status }}">
            <div class="text-left text-3xl font-medium">Edit Post</div>
            <div class="flex flex-row gap-2">
                <button onclick="saveAsDraft(event)"
                    class="w-28 py-2 rounded-md bg-white hover:bg-gray-100 ring-1 ring-black text-black font-medium flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-save">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    Save
                </button>
                <button onclick="publish(event)"
                    class="w-28 py-2 rounded-md bg-gray-900 hover:bg-gray-900/90 text-white font-medium flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-up-to-line">
                        <path d="M5 3h14" />
                        <path d="m18 13-6-6-6 6" />
                        <path d="M12 7v14" />
                    </svg>
                    Publish
                </button>
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
            </div>
        </div>
        <textarea style="resize:none" maxlength="255" name="title" id="title" placeholder="Title" rows="2"
            class="w-full text-5xl px-2 outline-none font-medium focus:border-0 py-2">{{ $blog->title }}</textarea>
        @error('title')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
        <textarea style="resize:none" type="text" name="subtitle" id="subtitle"
            class="w-full text-lg px-2 py-2 font-base focus:outline-none" placeholder="Subtitle" maxlength="100" rows="1">{{ $blog->subtitle }}</textarea>
        @error('subtitle')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
        @error('body')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
        @if (isset($blog->picture))
            <label for="image" class="w-full h-72 group relative">
                <div
                    class="group-hover:flex w-full h-72 z-20 hidden bg-gray-600/10 backdrop-blur-sm rounded-md justify-center items-center absolute inset-0">
                    Add Image
                </div>
                <label for="image" class="w-full h-72 pb-4 border-b object-left-top relative group">
                    {{-- <img src="{{ asset('storage/' . $blog->picture) }}" alt="{{ $blog->title }}"
                    class="object-cover object-left-top rounded-md w-full h-full"> --}}
                    <x-blog-picture :src="asset('storage/' . $blog->picture)" :alt="$blog->title" />
                </label>
            </label>
        @endif
        {{-- <textarea style="resize:none" class="w-full px-2 py-2 font-light outline-none decoration-transparent" name="body" id="content"
            rows="20" placeholder="Content">{{$blog->body}}</textarea> --}}
        <input id="body" type="hidden" name="body" value="{{ $blog->body }}">
        <trix-editor class="w-full" input="body"></trix-editor>
        <input type="file" name="image" id="image" value="{{ old('image', $blog->picture) }}"
            class="w-full hidden">
        @error('image')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </form>
</div>

<script>
    function deletePost(event, id) {
        event.preventDefault();
        const form = document.createElement('form');
        form.action = '/blog/' + id + '/delete';
        form.method = 'POST';
        form.innerHTML = '@csrf';
        document.body.appendChild(form);
        form.submit();
    }


    function saveAsDraft(e) {
        e.preventDefault();
        document.getElementById('status').value = 'draft';
        document.forms[0].submit();
    }

    function publish(e) {
        e.preventDefault();
        document.getElementById('status').value = 'published';
        document.forms[0].submit();
    }
</script>
