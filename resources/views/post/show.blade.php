@extends('layouts.main')

@section('content')
<div class="container mx-auto p-3">
    <a href="{{route('posts.index', ['page' => request('page')])}}" class="border-2 border-gray-200 rounded-lg p-2 inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left inline-block -mt-1" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>
        목록
    </a>
    <div class="mt-6">
        <x-category-link :category="$post->category"></x-category-link>
    </div>
    <h1 class="text-3xl mt-2">{{$post->subject}}</h1>
    <small class="text-sm">작성자 {{ $post->user->name }}</small>
    <small class="text-sm text-slate-500">{{ $post->created_at->diffforhumans() }}</small>
    <div class="mt-10">
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
</div>
@endsection