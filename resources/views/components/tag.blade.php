@foreach($tags as $tag)
    <a href="?tag={{ $tag->name }}" {{ $attributes->merge(['class' => 'border border-blue-900 p-1 rounded-sm text-sm text-blue-900']) }}>#{{ $tag->name }}</a>
@endforeach