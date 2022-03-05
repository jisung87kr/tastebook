@props(['post'])
<div class="col mb-4 p-2 border-2 border-gray-200 rounded-lg">
    <img src="https://via.placeholder.com/300x200" alt="" class="w-full mb-2">
    <x-category-link :category="$post->category"></x-category-link>
    <div class="my-2">
        <a href="{{ route('posts.show', [$post->id, 'page' => request('page') ]) }}">{{$post->subject}}</a>
    </div>
    <hr class="my-3">
    <div class="mb-1">write by {{$post->user->name}}</div>
    <smal class="text-slate-500">{{$post->created_at->diffforhumans()}}</smal>
</div>