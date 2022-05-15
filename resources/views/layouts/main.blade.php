<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
</head>
<body>
    <nav id="header" class="flex justify-between p-3 items-center">
        <div class="">
            <a href="{{ route('posts.index') }}" class="inline-block">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="block h-9 w-auto">
                    <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"></path>
                    <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"></path>
                </svg>
            </a>
        </div>
        <div class="ml-auto">
            @auth
                <x-dropdown>
                    <x-slot name="trigger">
                        {{ auth()->user()->name }}
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-item><a href="{{route('dashboard')}}">대시보드</a></x-dropdown-item>
                        <x-dropdown-item>
                                <a href="{{route('logout')}}" @click.prevent="document.getElementById('form-logout').submit()">로그아웃</a>
                                <form action="{{route('logout')}}" method="POST" id="form-logout" @logout_="alert('qwe')">
                                    @csrf
                                </form>
                        </x-dropdown-item>
                    </x-slot>
                </x-dropdown>
            @endauth
            @guest
                <div class="relative w-24"><a href="{{route('login')}}">로그인</a></div>
            @endguest
        </div>
    </nav>

    @yield('content')
{{--    <div id="newsletter" class="mx-auto p-3 mt-10 ">--}}
{{--        <div class="bg-slate-100 p-5 rounded-lg border-2 border-gray-200 text-center">--}}
{{--            <form action="" method="POST">--}}
{{--                @csrf--}}
{{--                <input type="text" name="email" placeholder="example@email.com" class="border-slate-200 border-2 px-2 py-3">--}}
{{--                <input type="submit" value="제출" class="px-2 py-3 bg-blue-900 text-white rounded-lg w-24 ml-2">--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div id="footer" class="container mx-auto p-6 mt-[150px]">
        <div class="border-t border-gray-300 pt-6 text-center text-gray-500">
            ujsstudio87@gmail.com
        </div>
    </div>
</body>
</html>