@extends('layouts.admin')

@section('content')
    <table class="border-collapse border border-slate-500 w-full" style="min-width: 800px;">
        <thead>
        <tr>
            <th class="border border-gray-400 p-1">아이디</th>
            <th class="border border-gray-400 p-1">제목</th>
            <th class="border border-gray-400 p-1">작성자</th>
            <th class="border border-gray-400 p-1">수정일</th>
            <th class="border border-gray-400 p-1">상태</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td class="border border-gray-400 p-1">{{ $post->id }}</td>
                <td class="border border-gray-400 p-1">
                    <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->subject }}</a>
                </td>
                <td class="border border-gray-400 p-1">{{ $post->user->name }}</td>
                <td class="border border-gray-400 p-1">{{ $post->updated_at->diffforhumans() }}</td>
                <td class="border border-gray-400 p-1 text-center">
                    @if($post->published_at)
                        <span class="rounded-lg bg-green-600 text-white p-2 text-xs">발행</span>
                    @else
                        <span class="rounded-lg bg-gray-600 text-white p-2 text-xs">미발행</span>
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $posts->links() }}
    </div>
@endsection