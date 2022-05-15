@props(['url'])
@foreach($tags as $tag)
    <a href="{{ $url }}?tag={{ $tag->name }}" {{ $attributes->merge(['class' => 'inline-block mb-1 mr-2 rounded-sm text-sm text-blue-900']) }}>#{{ $tag->name }}</a>
@endforeach