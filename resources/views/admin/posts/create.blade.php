<x-admin-layout>
    <x-slot name="breadcrumbs">{{ Breadcrumbs::render('admin.posts.create') }}</x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                <div class="p-3">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.posts.form-post')
                        <div class="text-right">
                            <input type="submit" value="저장" class="p-2 rounded-lg bg-blue-900 text-white mt-3 cursor-pointer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>