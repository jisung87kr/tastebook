<div>
    <h3 class="mt-5 mb-3 font-bold text-xl text-center">검색어를 입력하세요</h3>
    <form action="{{ route('posts.index') }}" class="mb-10 flex" method="GET">
        <div class="w-full">
            <input type="text" name="search" value="{{ request()->input('search') }}" class="border border-gray-200 p-2 rounded-l-lg w-full" id="search">
        </div>
        <div class="shrink-0 w-24">
            <input type="submit" value="검색" class="p-2 rounded-r-lg bg-blue-900 text-white cursor-pointer w-full">
        </div>
    </form>
</div>
