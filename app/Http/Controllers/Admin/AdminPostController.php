<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function posts()
    {
        $posts = Post::filter(request(['search', 'category']))->latest()->paginate(30)->withQueryString();
        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function create()
    {
        $post = new Post;
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $validatedData['slug'] = $request->input('slug') ?? $validatedData['subject'];
        $validatedData['published_at'] = $request->input('published_at') ? date('Y-m-d H:i:s') : null;

        $post = $request->user()->posts()->create($validatedData);

        if($request->file('files')){
            foreach ($request->file('files') as $index => $file) {
                $result = $file->store('public/posts/'.date('Y').'/'.date('m').'/'.date('d'));
                $fileInfo['path'] = $result;
                $fileInfo['name'] = $file->getClientOriginalName();
                $fileInfo['size'] = $file->getSize();
                $fileInfo['mineType'] = $file->getClientMimeType();
                $post->attachments()->create($fileInfo);
            }
        }

        return redirect()->route('admin.posts.edit', $post->id);
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'subject' => 'required|max:255',
            'content' => 'required',
        ]);

        $validatedData['published_at'] = $request->input('published_at') ? date('Y-m-d H:i:s') : null;
        $post->update($validatedData);

        if($request->file('files')){
            foreach ($request->file('files') as $index => $file) {
                $result = $file->store('public/posts/'.date('Y').'/'.date('m').'/'.date('d'));
                $fileInfo['path'] = $result;
                $fileInfo['name'] = $file->getClientOriginalName();
                $fileInfo['size'] = $file->getSize();
                $fileInfo['mineType'] = $file->getClientMimeType();
                $post->attachments()->create($fileInfo);
            }
        }

        return redirect()->route('admin.posts.edit', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}