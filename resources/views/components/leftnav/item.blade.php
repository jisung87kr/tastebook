<li class="block border-l pl-4 my-1 border-transparent hover:border-slate-400 text-slate-700 hover:text-slate-900 @if($active) border-slate-400 @endif">
    @if(!empty($items['child']))
    <x-accordian style="margin: 10px 0;" isChild="true" :items="$items"></x-accordian>
    @else
    <a href="{{ route($items['route']) }}" class="">{{ $slot }}</a>
    @endif
</li>