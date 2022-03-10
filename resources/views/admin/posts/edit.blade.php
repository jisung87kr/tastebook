@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @include('admin.posts.form-post')
    </form>
    <div class="text-right">
        <a href="{{ route('admin.posts.destroy', $post->id) }}"
           onclick="event.preventDefault();
            document.getElementById('form-delete').submit();"
        >삭제</a>
        <form action="{{ route('admin.posts.destroy', $post->id) }}" id="form-delete" method="POST" class="hidden">
            @csrf
        </form>
        <input type="submit" value="저장" class="p-2 rounded-lg bg-blue-900 text-white mt-3">
    </div>
@endsection