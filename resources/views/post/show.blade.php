@extends('layouts.main')

@section('content')
<div class="container mx-auto p-3">
    <a href="{{route('posts.index', ['page' => request('page')])}}" class="border-2 border-gray-200 rounded-lg p-2">< 목록</a>
    <div class="mt-4">
        <x-category-link :category="$post->category"></x-category-link>
    </div>
    <h1 class="text-3xl mt-4">{{$post->subject}}</h1>
    <small class="text-sm">작성자 {{ $post->user->name }}</small>
    <small class="text-sm text-slate-500">{{ $post->created_at->diffforhumans() }}</small>
    <div class="mt-10">
        {{$post->content}}
    </div>
</div>
@endsection