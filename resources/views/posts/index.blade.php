@extends('layouts.main')

@section('content')
<div id="content" class="container p-6 mx-auto">
    @include('posts.include.search')
    @if(request('search') && $posts->count())
        @include('posts.include.search-fillter')
    @endif
    <div class="mt-10 mb-6">
        <x-field-sort >초기화</x-field-sort>
        <x-field-sort field="view_cnt">인기순</x-field-sort>
        <x-field-sort field="id">최신순</x-field-sort>
        <x-field-sort field="comment_cnt">댓글순</x-field-sort>
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