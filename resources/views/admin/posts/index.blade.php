<x-admin-layout>
    <x-slot name="breadcrumbs">{{ Breadcrumbs::render('admin.posts.index') }}</x-slot>
    <div>
        <table class="border-collapse w-full">
            <thead>
            <tr class="border border-b-gray-400">
                <th class="p-2 text-sm">아이디</th>
                <th class="p-2 text-sm">제목</th>
                <th class="p-2 text-sm">작성자</th>
                <th class="p-2 text-sm">수정일</th>
                <th class="p-2 text-sm">상태</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr class="border border-b-gray-400">
                    <td class="p-2 text-sm text-center">{{ $post->id }}</td>
                    <td class="p-2 text-sm">
                        <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->subject }}</a>
                    </td>
                    <td class="p-2 text-sm text-center">{{ $post->user->name }}</td>
                    <td class="p-2 text-sm text-center">{{ $post->updated_at->diffforhumans() }}</td>
                    <td class="p-2 text-sm text-center">
                        @if($post->published_at)
                            <span class="rounded-lg bg-green-600 text-white px-2 py-1 text-xs">발행</span>
                        @else
                            <span class="rounded-lg bg-gray-600 text-white px-2 py-1 text-xs">미발행</span>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $posts->links() }}
        </div>
    </div>
</x-admin-layout>