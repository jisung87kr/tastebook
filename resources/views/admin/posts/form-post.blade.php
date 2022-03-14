<div class="flex">
    <lable class="mr-2 basis-20 shrink-0" for="published_at">발행</lable>
    <input type="checkbox" name="published_at" value="1" @if($post->published_at) checked @endif>
</div>
<div class="flex mt-2">
    <lable class="mr-2 basis-20 shrink-0" for="category">카테고리</lable>
    <select name="category_id" id="category" class="border border-gray-200 p-1 rounded-lg">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="flex mt-2">
    <lable class="mr-2 basis-20 shrink-0" for="subject">제목</lable>
    <div class=" w-full">
        <input type="text" name="subject" value="{{ $post->subject }}" class="border border-gray-200 p-1 rounded-lg w-full" id="subject">
        @error('subject')
            <div class="text-red-500 mt-1 text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="flex mt-2">
    <lable class="mr-2 basis-20 shrink-0" for="content">내용</lable>
    <div class="w-full">
        <textarea name="content" id="content" cols="30" rows="10" class="border border-gray-200 p-1 rounded-lg w-full">{{ $post->content }}</textarea>
        @error('content')
            <div class="text-red-500 mt-1 text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>