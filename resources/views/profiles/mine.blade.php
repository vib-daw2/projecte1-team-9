@extends('layout')
<div class="w-full min-h-screen flex justify-start flex-col items-center py-8">
    <div class="max-w-5xl w-full mx-auto h-fit flex flex-col justify-start items-start gap-3">
        <x-profiletabs selected="profile" />
        <div class="flex flex-col w-full h-fit justify-center items-center mt-4 gap-4">
            <x-profilestats :username="$username" />
            <form class="flex flex-row w-full h-fit" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="jpeg,png,svg">
                <div class="w-1/4">
                    <label for="profile_picture" class="w-36 h-36 bg-black mx-auto cursor-pointer group relative flex justify-center items-center text-white text-4xl rounded-full">
                        @if(isset($profile_picture))
                            <img id="picture" src="{{asset("storage/".$profile_picture)}}" alt="{{strtoupper($username[0])}}" class="object-fit rounded-full w-full h-full m-auto">
                        @else
                            <div>{{strtoupper($username[0])}}</div>
                        @endif
                        {{-- <div class="group-hover:hidden">{{strtoupper($username[0])}}</div> --}}
                        <div class="group-hover:flex absolute flex-col justify-center items-center hidden w-36 h-36 bg-gray-900 bg-opacity-50 backdrop-blur text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus"><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7"/><line x1="16" x2="22" y1="5" y2="5"/><line x1="19" x2="19" y1="2" y2="8"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            <div class="text-sm text-center">Upload Image</div>
                        </div>
                        @if(isset($profile_picture))
                        <button type="button" onclick="resetImage()" class="z-50 absolute bottom-0 right-0 w-8 h-8 flex justify-center items-center rounded-full bg-black">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                        @endif
                    </label>
                    @error('profile_picture')
                        <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>
                <div class="w-3/4 flex flex-col gap-3 px-4">
                    <div class="w-full">
                        <label class="block">Username</label>
                        <input type="text" name="username" id="username" value="{{ $username }}"
                            class="px-2 py-1 border-b-black border-b outline-none w-full text-gray-700">
                    </div>
                    <div class="w-full">
                        <label class="block">Email</label>
                        <input type="email" name="email" id="email" value="{{ $email }}"
                            class="px-2 py-1 border-b-black border-b outline-none w-full text-gray-700">
                    </div>
                    <div class="w-full">
                        <label class="block">Password</label>
                        <input type="password" name="password1" id="password1"
                            class="px-2 py-1 border-b-black border-b outline-none text-gray-700 w-full">
                    </div>
                    <div class="w-full flex justify-end gap-3">
                        <a href="/me/password"
                            class="w-28 min-w-fit px-2 py-2 rounded-md bg-white hover:bg-gray-100 ring-1 ring-black text-black font-medium flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-key-round">
                                <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z" />
                                <circle cx="16.5" cy="7.5" r=".5" />
                            </svg>
                            Change Password
                        </a>
                        <button
                            class="w-28 py-2 rounded-md bg-gray-900 hover:bg-gray-900/90 text-white font-medium flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-save">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Save
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    const image = document.querySelector('#profile_picture');
    const label = document.querySelector('label[for="profile_picture"]');
    image.addEventListener('change', (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onloadend = () => {
            label.style.backgroundImage = `url(${reader.result})`;
        }
        reader.readAsDataURL(file);
    });

    function resetImage() {
        const image = document.querySelector('#profile_picture');
        const label = document.querySelector('label[for="profile_picture"]');
        const pic = document.querySelector('#picture');
        pic.src = "";
        image.value = "";
        label.style.backgroundImage = `url()`;
       
    }
</script>