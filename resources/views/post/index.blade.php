@extends('layouts.main')

@section('content')
<div id="content" class="container p-6 mx-auto">
    @include('post.include.search')
    @if(request('search') && $posts->count())
        @include('post.include.search-fillter')
    @endif
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