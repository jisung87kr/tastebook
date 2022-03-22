@extends('layouts.admin')

@section('content')
    <div x-data>
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" x-ref="form">
            @csrf
            @method('PATCH')
            @include('admin.posts.form-post')
        </form>
        <div class="text-right">
            <a href="{{ route('admin.posts.destroy', $post->id) }}"
               class="p-2 rounded-lg bg-red-900 text-white mt-3"
               onclick="event.preventDefault();
                   if(!confirm('삭제 하시겠습니까?')){ return false; }
                   document.getElementById('form-delete').submit();"
            >삭제</a>
            <form action="{{ route('admin.posts.destroy', $post->id) }}" id="form-delete" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
            <input type="submit" value="저장" class="p-2 rounded-lg bg-blue-900 text-white mt-3 cursor-pointer" @click="$refs.form.submit()">
        </div>
    </div>
@endsection