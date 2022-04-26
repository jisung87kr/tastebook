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
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

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
    <div id="newsletter" class="mx-auto p-3 mt-10 ">
        <div class="bg-slate-100 p-5 rounded-lg border-2 border-gray-200 text-center">
            <form action="" method="POST">
                @csrf
                <input type="text" name="email" placeholder="example@email.com" class="border-slate-200 border-2 px-2 py-3">
                <input type="submit" value="제출" class="px-2 py-3 bg-blue-900 text-white rounded-lg w-24 ml-2">
            </form>
        </div>
    </div>
</body>
</html>