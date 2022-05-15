<h3 class="mt-5 mb-3 font-bold text-xl">필터</h3>
<form action="{{ route('posts.index') }}" class="mb-10 border border-gray-200 p-5 rounded-lg" method="GET">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <div class="flex my-5">
        <label class="mr-2 basis-20 shrink-0">카테고리</label>
        <div class="flex flex-wrap">
        @foreach($categories as $category)
            <div class="mr-3">
                <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                <input type="checkbox" name="category[]" value="{{ $category->id }}" id="category_{{ $category->id }}"
                       @if(request()->input('category') && in_array($category->id, request()->input('category')) ) checked @endif
                >
            </div>
        @endforeach
        </div>
    </div>
    <div class="flex my-5">
        <lable class="mr-2 basis-20 shrink-0" for="except">제외단어</lable>
        <div class="w-full">
            <input type="text" name="except" value="{{ request()->input('except') }}"
                   class="border border-gray-200 w-full"
                   id="except"
                   placeholder="쉼표로 구분합니다"
            >
        </div>
    </div>
    <div>
        <input type="submit" value="검색" class="p-2 bg-blue-900 text-white mt-3 cursor-pointer w-24">
    </div>
</form>