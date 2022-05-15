@props(['url'])
@foreach($tags as $tag)
    <a href="{{ $url }}?tag={{ $tag->name }}" {{ $attributes->merge(['class' => 'inline-block mb-1 border border-blue-900 p-1 rounded-sm text-sm text-blue-900']) }}>#{{ $tag->name }}</a>
@endforeach