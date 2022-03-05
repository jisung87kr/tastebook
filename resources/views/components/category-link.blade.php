@props(['category'])
<a href="{{ route('posts.index', ['category' => $category->id]) }}"
   {{ $attributes->merge(['class' => 'py-1 px-3 bg-blue-500 text-white rounded-lg text-sm']) }}>
    {{ $category->name }}
</a>