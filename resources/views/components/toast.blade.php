<script>
    function closeToast() {
        document.getElementById('toast').classList.remove('animate-toastin');
        document.getElementById('toast').classList.add('animate-toastout');
    }
</script>
@php
    $status = session('status');
@endphp
@if ($status)
    <div id="toast"
        class="w-full fixed top-0 right-0 max-w-lg h-28 mr-4 mt-4 rounded-lg bg-white gap-8 drop-shadow-lg animate-toastin flex justify-between items-center">
        <div
            class="w-fit px-4 @if ($status['success']) bg-emerald-600 @else bg-red-600 @endif h-full flex justify-center items-center rounded-l-md">
            @if ($status['success'])
                <svg class="stroke-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-check-circle">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            @else
                <svg class="stroke-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-x-circle">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m15 9-6 6" />
                    <path d="m9 9 6 6" />
                </svg>
            @endif
        </div>
        <div class="flex flex-col w-full items-start">
            <div class="font-medium @if ($status['success']) text-emerald-600 @else text-red-600 @endif">
                {{ $status['title'] }}</div>
            <div class="font-">{{ $status['message'] }}</div>
        </div>
        <div class="absolute right-2 top-2" onclick="closeToast()"><svg xmlns="http://www.w3.org/2000/svg"
                width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg></div>
    </div>
    </div>
@endif
