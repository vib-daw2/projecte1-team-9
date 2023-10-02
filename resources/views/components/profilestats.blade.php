@php
    use App\Models\User;
    $user = User::where('username', '=', $username)->first();
    $stats = $user->getProfileStats();
@endphp

<div class="w-full h-full pb-4 border-b border-b-black">
    <div class="w-36 h-36 mx-auto bg-black flex justify-center items-center text-white text-4xl rounded-full">
        {{strtoupper($username[0])}}
    </div>
    <div class="font-medium mt-4 text-center text-lg">@ {{$username}}</div>
    <div class="mt-4 font-base text-lg px-4 flex flex-row gap-2 w-full justify-between">
        <div class="py-1 w-1/3 text-center"><b>{{$stats->likes}}</b> Likes</div>
        <div class="py-1 w-1/3 text-center"><b>{{$stats->posts_count}}</b> Posts</div>
        @php
         $up_since = getDate(strtotime($stats->up_since));   
        @endphp
        <div class="py-1 w-1/3 text-center">Up since: <b>{{$up_since['month']}} {{$up_since['year']}}</b></div>
    </div>
</div>
