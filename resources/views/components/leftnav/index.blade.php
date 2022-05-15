<div x-data="{open: @if(isset($isChild)) false @else true @endif}">
    <x-leftnav.title class="@if(!isset($isChild)) mb-8 lg:mb-3 @endif"
            @click="open = !open"
    >
    {{ $items['name'] }}
    </x-leftnav.title>
    <ul x-show="open" x-transition style="display: none"
        class="@if(isset($isChild)) my-2 @endif"
    >

    @foreach($items['child'] as $key => $value)
        <x-leftnav.item :items="$value" :active="request()->routeIs($value['route'])">{{ $value['name'] }}</x-leftnav.item>
    @endforeach
    </ul>
</div>