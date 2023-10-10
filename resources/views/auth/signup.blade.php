@extends('layout')
<style>
    #bg {
        background-image: url('../../public/stacked-waves-haikei.png');
    }
</style>
<div id="bg" class="w-full h-screen -z-20 fixed inset-0">
    <svg id="visual" viewBox="0 0 1920 1080" width="1920" height="1080" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
        <path
            d="M0 217L29.2 213.3C58.3 209.7 116.7 202.3 174.8 202.3C233 202.3 291 209.7 349.2 240.3C407.3 271 465.7 325 523.8 370C582 415 640 451 698.2 451C756.3 451 814.7 415 872.8 382.7C931 350.3 989 321.7 1047.2 291C1105.3 260.3 1163.7 227.7 1221.8 245.7C1280 263.7 1338 332.3 1396.2 325.2C1454.3 318 1512.7 235 1570.8 193.5C1629 152 1687 152 1745.2 177.2C1803.3 202.3 1861.7 252.7 1890.8 277.8L1920 303L1920 0L1890.8 0C1861.7 0 1803.3 0 1745.2 0C1687 0 1629 0 1570.8 0C1512.7 0 1454.3 0 1396.2 0C1338 0 1280 0 1221.8 0C1163.7 0 1105.3 0 1047.2 0C989 0 931 0 872.8 0C814.7 0 756.3 0 698.2 0C640 0 582 0 523.8 0C465.7 0 407.3 0 349.2 0C291 0 233 0 174.8 0C116.7 0 58.3 0 29.2 0L0 0Z"
            fill="#f2f2f2"></path>
        <path
            d="M0 660L29.2 640.2C58.3 620.3 116.7 580.7 174.8 577C233 573.3 291 605.7 349.2 618.3C407.3 631 465.7 624 523.8 629.5C582 635 640 653 698.2 653C756.3 653 814.7 635 872.8 613.3C931 591.7 989 566.3 1047.2 575.3C1105.3 584.3 1163.7 627.7 1221.8 649.3C1280 671 1338 671 1396.2 660.2C1454.3 649.3 1512.7 627.7 1570.8 615C1629 602.3 1687 598.7 1745.2 609.5C1803.3 620.3 1861.7 645.7 1890.8 658.3L1920 671L1920 301L1890.8 275.8C1861.7 250.7 1803.3 200.3 1745.2 175.2C1687 150 1629 150 1570.8 191.5C1512.7 233 1454.3 316 1396.2 323.2C1338 330.3 1280 261.7 1221.8 243.7C1163.7 225.7 1105.3 258.3 1047.2 289C989 319.7 931 348.3 872.8 380.7C814.7 413 756.3 449 698.2 449C640 449 582 413 523.8 368C465.7 323 407.3 269 349.2 238.3C291 207.7 233 200.3 174.8 200.3C116.7 200.3 58.3 207.7 29.2 211.3L0 215Z"
            fill="#eeeeee"></path>
        <path
            d="M0 779L29.2 777.2C58.3 775.3 116.7 771.7 174.8 780.7C233 789.7 291 811.3 349.2 809.5C407.3 807.7 465.7 782.3 523.8 778.7C582 775 640 793 698.2 807.3C756.3 821.7 814.7 832.3 872.8 800C931 767.7 989 692.3 1047.2 685.2C1105.3 678 1163.7 739 1221.8 782.2C1280 825.3 1338 850.7 1396.2 836.3C1454.3 822 1512.7 768 1570.8 737.3C1629 706.7 1687 699.3 1745.2 708.3C1803.3 717.3 1861.7 742.7 1890.8 755.3L1920 768L1920 669L1890.8 656.3C1861.7 643.7 1803.3 618.3 1745.2 607.5C1687 596.7 1629 600.3 1570.8 613C1512.7 625.7 1454.3 647.3 1396.2 658.2C1338 669 1280 669 1221.8 647.3C1163.7 625.7 1105.3 582.3 1047.2 573.3C989 564.3 931 589.7 872.8 611.3C814.7 633 756.3 651 698.2 651C640 651 582 633 523.8 627.5C465.7 622 407.3 629 349.2 616.3C291 603.7 233 571.3 174.8 575C116.7 578.7 58.3 618.3 29.2 638.2L0 658Z"
            fill="#ebebeb"></path>
        <path
            d="M0 962L29.2 951.2C58.3 940.3 116.7 918.7 174.8 922.3C233 926 291 955 349.2 956.8C407.3 958.7 465.7 933.3 523.8 931.5C582 929.7 640 951.3 698.2 951.3C756.3 951.3 814.7 929.7 872.8 900.8C931 872 989 836 1047.2 828.8C1105.3 821.7 1163.7 843.3 1221.8 874C1280 904.7 1338 944.3 1396.2 949.7C1454.3 955 1512.7 926 1570.8 908C1629 890 1687 883 1745.2 890.3C1803.3 897.7 1861.7 919.3 1890.8 930.2L1920 941L1920 766L1890.8 753.3C1861.7 740.7 1803.3 715.3 1745.2 706.3C1687 697.3 1629 704.7 1570.8 735.3C1512.7 766 1454.3 820 1396.2 834.3C1338 848.7 1280 823.3 1221.8 780.2C1163.7 737 1105.3 676 1047.2 683.2C989 690.3 931 765.7 872.8 798C814.7 830.3 756.3 819.7 698.2 805.3C640 791 582 773 523.8 776.7C465.7 780.3 407.3 805.7 349.2 807.5C291 809.3 233 787.7 174.8 778.7C116.7 769.7 58.3 773.3 29.2 775.2L0 777Z"
            fill="#e3e3e3"></path>
        <path
            d="M0 1081L29.2 1081C58.3 1081 116.7 1081 174.8 1081C233 1081 291 1081 349.2 1081C407.3 1081 465.7 1081 523.8 1081C582 1081 640 1081 698.2 1081C756.3 1081 814.7 1081 872.8 1081C931 1081 989 1081 1047.2 1081C1105.3 1081 1163.7 1081 1221.8 1081C1280 1081 1338 1081 1396.2 1081C1454.3 1081 1512.7 1081 1570.8 1081C1629 1081 1687 1081 1745.2 1081C1803.3 1081 1861.7 1081 1890.8 1081L1920 1081L1920 939L1890.8 928.2C1861.7 917.3 1803.3 895.7 1745.2 888.3C1687 881 1629 888 1570.8 906C1512.7 924 1454.3 953 1396.2 947.7C1338 942.3 1280 902.7 1221.8 872C1163.7 841.3 1105.3 819.7 1047.2 826.8C989 834 931 870 872.8 898.8C814.7 927.7 756.3 949.3 698.2 949.3C640 949.3 582 927.7 523.8 929.5C465.7 931.3 407.3 956.7 349.2 954.8C291 953 233 924 174.8 920.3C116.7 916.7 58.3 938.3 29.2 949.2L0 960Z"
            fill="#dbdbdb"></path>
    </svg>
</div>
<div class="w-full flex justify-center items-center min-h-screen overflow-hidden">
    <div class="w-full flex justify-center items-start drop-shadow-lg">
        <x-external-auth />
        <div class="rounded-lg border h-fit w-full max-w-md p-8 bg-white rounded-tl-none">
            <div class="text-2xl font-medium">Sign Up</div>
            <form class="w-full mt-8 flex flex-col gap-4 " method="POST">
                @csrf
                <div class="w-full">
                    <label class="block">Username</label>
                    <input type="text" value="{{ old('username') }}" name="username" id="username"
                        placeholder="Username"
                        class="px-2 py-1 @error('username') border-b-red-500 @else border-b-black @enderror outline-none border-b w-full">
                    @error('username')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="block">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" id="email"
                        placeholder="email@blogify.com"
                        class="px-2 py-1 @error('email') border-b-red-500 @else border-b-black @enderror border-b outline-none w-full">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="block">Password</label>
                    <input type="password" name="password1" id="password1" placeholder="●●●●●●"
                        class="px-2 py-1 @error('password1') border-b-red-500 @else border-b-black @enderror border-b outline-none w-full">
                    @error('password1')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="block">Repeat Password</label>
                    <input type="password" name="password2" id="password2" placeholder="●●●●●●"
                        class="px-2 py-1 @error('password2') border-b-red-500 @else border-b-black @enderror border-b outline-none w-full">
                    @error('password2')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" value="Sign Up"
                    class="w-full bg-gray-900 hover:bg-gray-900/90 font-medium text-white py-2 rounded-lg cursor-pointer">
            </form>
            <div class="w-full h-4 mt-4 flex justify-center items-center">
                <div class="w-5/12">
                    <div class="h-1/2 border-b"></div>
                </div>
                <div class="w-2/12 text-center">or</div>
                <div class="w-5/12">
                    <div class="h-1/2 border-b"></div>
                </div>
            </div>
            <a href="/login"
                class="w-full mt-4 block bg-white hover:bg-gray-50 font-medium text-black ring-1 ring-black py-2 rounded-lg text-center">Log
                in</a>
        </div>
    </div>
</div>
