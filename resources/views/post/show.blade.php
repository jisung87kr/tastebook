@extends('layouts.main')

@section('content')
<div class="container mx-auto p-3">
    <x-breadscrumbs class="mb-5">{{ Breadcrumbs::render('posts.show', $post) }}</x-breadscrumbs>
    <a href="{{route('posts.index', ['page' => request('page')])}}" class="border-2 border-gray-200 rounded-lg p-2 inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left inline-block -mt-1" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>
        목록
    </a>
    <div class="subject relative pr-10">
        <h1 class="text-3xl mt-5">{{$post->subject}}</h1>
        @can('update', $post)
            <a href="{{ route('admin.posts.edit', $post) }}" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil absolute top-2 right-0" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
        @endcan
    </div>
    <small class="text-sm">작성자 {{ $post->user->name }}</small>
    <small class="text-sm text-slate-500">{{ $post->created_at->diffforhumans() }}</small>
    <div class="my-3">
        <x-category-link :category="$post->category"></x-category-link>
    </div>
    <div class="my-10">
        {{$post->content}}
    </div>
    @if($post->attachments->count() > 0)
    <hr class="py-5">
    <div class="my-gallery grid grid-cols-4 gap-2">
        @foreach($post->attachments as $attachment)
            <figure class="border rounded-sm">
                <a href="{{ Storage::url($attachment->path) }}" data-size="{{ $attachment->width .'x'. $attachment->height }}">
                    <img src="{{ Storage::url($attachment->path) }}" alt="">
                </a>
            </figure>
        @endforeach
    </div>
    <x-photoswipe></x-photoswipe>
    @endif

    <div class="my-5">
        <x-tag :tags="$post->tags"></x-tag>
    </div>

    <div class="comment-box mt-5"
         x-data="{
            content: '',
            action: '{{ route('posts.storeComment', $post) }}',
            btn: '댓글등록',
            method: 'POST',
            update(comment) {
                this.content = comment.content;
                this.btn = '댓글수정';
                this.action = '/comments/'+comment.id;
                this.method = 'PUT';
            },
            reply(comment) {
                this.btn = '댓글달기';
                this.action = '/posts/{{ $post->id }}/comments/'+comment.id;
                this.method = 'POST';
            },
         }"
         @update="update($event.detail)"
         @reply="reply($event.detail)"
    >
        @if(Auth::check())
        <h5 class="my-2">댓글을 입력하세요</h5>
        <div class="mb-5">
            <form :action="action" method="POST">
                @csrf
                <input type="hidden" name="_method" :value="method">
                <textarea name="content" id="content" cols="30" rows="10" class="border border-gray-200 p-2 w-full" x-model="content"></textarea>
                <input type="submit" :value="btn" class="p-2 rounded-lg bg-blue-900 text-white mt-1 cursor-pointer text-sm">
            </form>
        </div>
        @else
            <div>
                댓글을 작성하려면 <a href="{{ route('login') }}" class="text-blue-600">로그인</a> 하세요
            </div>
        @endif
        <h5 class="my-2">댓글 ({{ $post->comments->count() }})</h5>
        @forelse($post->comments()->comment()->get() as $comment)
            <x-comment :comment="$comment"></x-comment>
        @empty
            <p>No comments</p>
        @endforelse
    </div>
    @if(session()->has('success'))
        <x-flash>
            <x-slot name="message">{{ session()->get('success') }}</x-slot>
        </x-flash>
    @endif
</div>
@endsection