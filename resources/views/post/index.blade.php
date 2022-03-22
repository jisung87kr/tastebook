@extends('layouts.main')

@section('content')
<h1 class="text-center text-6xl my-4">포스팅 목록</h1>

<form action="" class="text-center my-10">
    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    <x-category-dropdown></x-category-dropdown>
    <input type="text" name="search" class="px-2 py-3 bg-gray-50 rounded-xl" placeholder="검색어를 입력하세요" value="{{request('search')}}">
</form>
<div id="content" class="container p-6 mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($posts as $post)
            <x-post-card :post="$post"></x-post-card>
        @endforeach
    </div>

    {{$posts->links()}}
</div>
@endsection