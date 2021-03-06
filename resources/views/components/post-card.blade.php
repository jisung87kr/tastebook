@props(['post'])
<div class="col mb-4 p-2 border-2 border-gray-200 rounded-lg">
    <img src="{{ $post->getThumbnailUrl() }}" alt="" class="w-full mb-2">
    <x-category-link :category="$post->category"></x-category-link>
    <div class="my-3">
        <a href="{{ route('posts.show', [$post->id, 'page' => request('page') ]) }}">{{$post->subject}}</a>
    </div>
    <div class="">
        <x-tag :tags="$post->tags" url="{{ route('posts.index') }}" class="border-0"></x-tag>
    </div>
    <hr class="my-3">
    <div>
        <small class="mb-1">{{$post->user->name}}</small>
        <small class="text-slate-500">{{$post->created_at->diffforhumans()}}</small>
        <small class="text-slate-500">| {{$post->comments_count}}κ°μ λκΈ</small>
    </div>
</div>