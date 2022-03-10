@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        @include('admin.posts.form-post')
    </form>
    <div class="text-right">
        <input type="submit" value="저장" class="p-2 rounded-lg bg-blue-900 text-white mt-3">
    </div>
@endsection