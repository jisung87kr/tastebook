<div x-data="{open: @if(isset($isChild)) false @else true @endif}">
    <x-accordian.title class="@if(!isset($isChild)) mb-8 lg:mb-3 @endif"
            @click="open = !open"
    >
    {{ $items['name'] }}
    </x-accordian.title>
    <ul x-show="open" x-transition style="display: none"
        class="@if(isset($isChild)) my-2 @endif"
    >

    @foreach($items['child'] as $key => $value)
        <x-accordian.item :items="$value">{{ $value['name'] }}</x-accordian.item>
    @endforeach
    </ul>
</div>