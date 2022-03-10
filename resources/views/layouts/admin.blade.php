<!doctype html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Scripts -->
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
</head>
<body>
    <nav id="header" class="flex justify-between p-3 items-center">
        <div class="">
            <a href="{{ route('posts.index') }}" class="bg-blue-900 text-white px-5 py-3 rounded-lg inline-block">home</a>
        </div>
        <div class="ml-auto">
            @auth
                <x-dropdown>
                    <x-slot name="trigger">
                        {{ auth()->user()->name }}
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-item><a href="{{route('admin.index')}}">대시보드</a></x-dropdown-item>
                        <x-dropdown-item><a href="{{route('logout')}}">로그아웃</a></x-dropdown-item>
                    </x-slot>
                </x-dropdown>
            @endauth
            @guest
                <div class="relative w-24"><a href="{{route('login')}}">로그인</a></div>
            @endguest
        </div>
    </nav>

    <div class="flex bg-gray-50">
        <nav class="basis-48 bg-white p-3 shrink-0">
            <div class="mb-2">
                <div class="font-bold mb-1">포스트관리</div>
                <ul class="pl-2 text-gray-900">
                    <li class="hover:text-blue-700"><a href="{{ route('admin.posts.index') }}">목록</a></li>
                    <li class="hover:text-blue-700"><a href="{{ route('admin.posts.create') }}">글쓰기</a></li>
                </ul>
            </div>
            <div class="mb-2">
                <div class="font-bold mb-1">설정</div>
                <ul class="pl-2 text-gray-900">
                    <li class="hover:text-blue-700"><a href="">일반</a></li>
                </ul>
            </div>
        </nav>
        <div class="w-full p-5">
            <div class="bg-white p-5 rounded-lg shadow-md overflow-x-auto">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>