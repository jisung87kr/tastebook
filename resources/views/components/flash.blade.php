<div x-data="{show: true}"
     x-init="setTimeout( () => show = false, 4000 )"
     x-show="show"
     {{ $attributes->merge(['class' => 'fixed right-1 top-1 bg-green-600 text-white rounded-lg px-3 py-2']) }}>
    <p>{{ $message }}</p>
</div>