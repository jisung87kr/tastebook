@props(['field'])
<a href="?@if(isset($field)){{ fieldSort([$field, @request()->input('sort')[$field]]) }}@endif"
        {{ $attributes->merge(['class' => 'border border-gray-200 p-3 rounded-lg']) }}>{{ $slot }}</a>