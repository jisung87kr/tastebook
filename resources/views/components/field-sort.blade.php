@props(['field'])
<a href="?@if(isset($field)){{ fieldSort([$field, @request()->input('sort')[$field]]) }}@endif"
        {{ $attributes->merge(['class' => 'border border-gray-200 p-3 rounded-lg mr-2']) }}>
    {{ $slot }}
    @if(@request()->input('sort')[$field] == 'asc')
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-caret-up-fill inline-block icon-sort" viewBox="0 0 16 16">
                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
        </svg>
    @elseif(@request()->input('sort')[$field] == 'desc')
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-caret-down-fill inline-block icon-sort" viewBox="0 0 16 16">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
        </svg>
    @endif
</a>