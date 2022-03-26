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
<div class="flex mt-2">
    <lable class="mr-2 basis-20 shrink-0" for="content">이미지</lable>
    <div class="w-full">
        <input type="file" name="files[]" class="border border-gray-200 p-1 rounded-lg w-full" multiple>
        @error('content')
        <div class="text-red-500 mt-1 text-xs">{{ $message }}</div>
        @enderror
        @if($post->attachments)
            <div class="mt-1 grid grid-cols-4 gap-4">
                @foreach($post->attachments AS $attachment)
                    <div class="file-item relative border-2 border-gray-200 rounded-lg p-1" x-data x-ref="item">
                        <a href="{{ Storage::url($attachment->path) }}" target="_blank">
                            <img src="{{ Storage::url($attachment->path) }}" alt="">
                        </a>
                        <div>
                            <div target="_blank" class="text-xs text-gray-500 mt-2 break-words">{{ $attachment->name }}</div>
                        </div>
                        <div @click="removefile({{ $attachment->id }}, $refs.item)" class="text-xs p-1 bg-red-500 text-white rounded-lg absolute top-1 right-1 cursor-pointer">삭제</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="flex mt-2">
    <lable class="mr-2 basis-20 shrink-0" for="tags">태그</lable>
    <div class=" w-full">
        <input type="text" name="tags" value="{{ $post->tags->pluck('name')->implode(', ') }}" class="border border-gray-200 p-1 rounded-lg w-full" id="tags">
        @error('tags')
        <div class="text-red-500 mt-1 text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function removefile(id, refs){
        event.preventDefault();
        if(!confirm('삭제 하시겠습니까?')){
            return false;
        }
        axios.delete('http://tastebook.test:81/attachments/'+id).then(function(response){
            alert('삭제 완료');
            refs.remove();
        });
    }
</script>
