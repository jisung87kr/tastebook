<x-app-layout>
    <div class="flex">
        <x-leftmenu class="p-5 w-48 fixed left-0 bottom-0 z-0 h-full overflow-y-auto" style="height: 100%; top:  65px;">
            @foreach($menu as $key => $value)
                <x-accordian :items="$value"></x-accordian>
            @endforeach
        </x-leftmenu>
        <div class="w-full" style="padding-left: 192px">
            <div class="mx-auto sm:px-6 lg:px-8">
                <x-breadscrumbs class="bg-white overflow-hidden shadow-md sm:rounded-lg my-5 p-3">{{ $breadscrumbs }}</x-breadscrumbs>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>