<div class="flex flex-row w-full items-center justify-between rounded-lg py-1 px-2 gap-2">
    <a href="/me"
        class="w-full py-1 font-medium text-center rounded-lg {{ $selected == 'profile' ? 'bg-black text-white' : 'hover:bg-gray-300' }}">
        Profile
    </a>
    <a href="/me/posts"
        class="w-full py-1 text-center font-medium {{ $selected == 'posts' ? 'bg-black text-white' : 'hover:bg-gray-300' }} rounded-lg">Posts</a>
    <a href="/me/likes"
        class="w-full py-1 text-center font-medium {{ $selected == 'likes' ? 'bg-black text-white' : 'hover:bg-gray-300' }} rounded-lg">Likes</a>
</div>
