@extends('layouts.main')

@section('content')
<div id="content" class="container p-6 mx-auto">
    <h3 class="mt-5 mb-3 font-bold text-xl">필터</h3>
    <form action="{{ route('posts.index') }}" class="mb-10 border border-gray-200 p-3 rounded-lg" method="GET">
        <div class="flex mt-4">
            <label class="mr-2 basis-20 shrink-0">카테고리</label>
            @foreach($categories as $category)
                <div class="mr-3">
                    <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                    <input type="checkbox" name="category[]" value="{{ $category->id }}" id="category_{{ $category->id }}"
                    @if(request()->input('category') && in_array($category->id, request()->input('category')) ) checked @endif
                    >
                </div>
            @endforeach
        </div>
        <div class="flex mt-4">
            <lable class="mr-2 basis-20 shrink-0" for="except">제외단어</lable>
            <div class="w-full">
                <input type="text" name="except" value="{{ request()->input('except') }}"
                       class="border border-gray-200 p-1 rounded-lg w-full"
                       id="except"
                       placeholder="쉼표로 구분합니다"
                >
            </div>
        </div>
        <div class="flex mt-4">
            <lable class="mr-2 basis-20 shrink-0" for="search">검색어</lable>
            <div class="w-full">
                <input type="text" name="search" value="{{ request()->input('search') }}" class="border border-gray-200 p-1 rounded-lg w-full" id="search">
            </div>
        </div>
        <div>
            <input type="submit" value="검색" class="p-2 rounded-lg bg-blue-900 text-white mt-3 cursor-pointer">
        </div>
    </form>
    <div class="mt-10 mb-6">
        <a href="" class="border border-gray-200 p-3 rounded-lg">인기순</a>
        <a href="" class="border border-gray-200 p-3 rounded-lg">최신순</a>
        <a href="" class="border border-gray-200 p-3 rounded-lg">댓글순</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($posts as $post)
            <x-post-card :post="$post"></x-post-card>
        @empty
            <div class="">
                검색결과가 없습니다.
            </div>
        @endforelse
    </div>

    {{$posts->links()}}
</div>
@endsection