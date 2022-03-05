<x-dropdown>
    <x-slot name="trigger">카테고리</x-slot>
    <x-slot name="content">
        @foreach($categories as $category)
        <x-dropdown-item>
            <a href="{{ route('posts.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
        </x-dropdown-item>
        @endforeach
    </x-slot>
</x-dropdown>