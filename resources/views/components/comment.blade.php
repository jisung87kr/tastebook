<div {{ $attributes->merge(['class'=> 'comment-item border border-gray-200 rounded-sm p-2 my-2']) }}
x-data="{id : {{ $comment->id }} }"
>
    <div class="text-xs text-gray-800">
        <div>
            <span>{{ $comment->user->name }}</span>
            <span>{{ $comment->created_at->diffforhumans() }}</span>
        </div>
        <div class="my-1">
            @can('update', $comment)
                <a href="#content" class="mr-1" @click="$dispatch('update', {{ $comment }})">수정</a>
            @endcan
            @can('delete', $comment)
                <a href="{{ route('comments.destroy', $comment) }}" class="mr-1" @click.prevent="$refs.form_comment_{{ $comment->id }}.submit();">삭제</a>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" x-ref="form_comment_{{ $comment->id }}" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endcan
            @can('create', $comment)
                <a href="#content" class="mr-1" @click="$dispatch('reply', {{ $comment }})">댓글달기</a>
            @endcan
        </div>
    </div>
    <hr>
    <div class="mt-1">
        @if($comment->deleted_at)
            삭제된 댓글 입니다.
        @else
            {{ $comment->content }}
        @endif
    </div>
</div>
@foreach($comment->comments as $childComment)
<x-comment :comment="$childComment" class="ml-[{{ ( $loop->depth - 1) * 20 }}px]"></x-comment>
@endforeach

