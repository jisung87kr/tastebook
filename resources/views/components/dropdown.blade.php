<div x-data="{open: false}" class="relative inline-block">
    <div @click="open = !open" @click.away="open = false" class="text-center cursor-pointer">
        <span>
            {{ $trigger }}
            <x-icons.down></x-icons.down>
        </span>
    </div>
    <div x-show="open" class="text-left absolute bg-gray-100 rounded-lg py-3 w-24 z-50 right-0 mt-2 mx-h-6 overflow-y-auto" style="display: none; max-height: 300px;">
        {{ $content }}
    </div>
</div>