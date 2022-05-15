<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AttachmentController;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\storePostRequest;

class PostController extends Controller
{
    public function __construct(TagController $tagController, AttachmentController $attachmentController)
    {
        $this->tagController = $tagController;
        $this->attachmentController = $attachmentController;
        $this->attachmentController->path = 'public/posts';
    }

    public function index(){
        $posts = Post::filter(request(['search', 'category', 'except']))->published()->commentsCount()->fieldSort(request('sort'))->paginate(30)->withQueryString();
        $categories = Category::all();
        return view('posts.index', compact('posts', 'categories'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $post = new Post;
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
        $this->authorize('create', Post::class);
        $validatedData = $request->validated();

        $validatedData['published_at'] = $request->input('published_at') ? date('Y-m-d H:i:s') : null;

        $post = $request->user()->posts()->create($validatedData);

        if($request->file('files')){
            $this->attachmentController->storeAttachment($post, $request->file('files'));
        }

        $this->tagController->storeTags($post, $request->input('tags'));

        return redirect()->route('admin.posts.edit', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        $post->increment('view_cnt');
        return view('posts.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(storePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $validatedData = $request->validated();

        $validatedData['published_at'] = $request->input('published_at') ? date('Y-m-d H:i:s') : null;
        $post->update($validatedData);

        if($request->file('files')){
            $this->attachmentController->storeAttachment($post, $request->file('files'));
        }

        $this->tagController->storeTags($post, $request->input('tags'));
        return redirect()->route('admin.posts.edit', $post->id);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function storeComment(Request $request, Post $post, Comment $comment=null)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'content' => 'required'
        ]);

        $validated['user_id'] = $request->user()->id;

        if($comment){
            $validated['parent_id'] = $comment->id;
        }
        $comment = $post->comments()->create($validated);
        session()->flash('success', '댓글이 저장되었습니다.');
        return redirect()->route('posts.show', $post);
    }
}
