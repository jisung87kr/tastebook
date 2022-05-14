<li class="block border-l pl-4 -ml-px border-transparent hover:border-slate-400 text-slate-700 hover:text-slate-900">
    @if(!empty($items['child']))
    <x-accordian style="margin: 10px 0;" isChild="true" :items="$items"></x-accordian>
    @else
    <a href="{{ $items['url'] }}" class="">{{ $slot }}</a>
    @endif
</li>