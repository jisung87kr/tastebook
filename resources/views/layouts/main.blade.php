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
            <x-jet-dropdown align="right" width="60">
                <x-slot name="trigger">
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                            {{ auth()->user()->name }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </x-slot>
                <x-slot name="content">
                    <div class="w-60">
                        <!-- Team Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('환영합니다') }}
                        </div>
                        <x-jet-dropdown-link href="{{route('dashboard')}}">
                            {{ __('대시보드') }}
                        </x-jet-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{route('logout')}}" @click.prevent="document.getElementById('form-logout').submit()">
                            로그아웃
                            <form action="{{route('logout')}}" method="POST" id="form-logout" @logout_="alert('qwe')">
                                @csrf
                            </form>
                        </x-jet-dropdown-link>
                    </div>
                </x-slot>
            </x-jet-dropdown>
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