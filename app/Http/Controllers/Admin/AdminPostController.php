<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\PostController;
use App\Models\Post;

class AdminPostController extends PostController
{
    public function index(){
        $posts = Post::filter(request(['search', 'category']))->latest()->paginate(30)->withQueryString();
        return view('admin.posts.index', compact('posts'));
    }
}
