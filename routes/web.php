<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('posts', PostController::class);
Route::resource('attachments', AttachmentController::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::post('/posts/{post}/comments/{comment?}', [PostController::class, 'storeComment'])->name('posts.storeComment');
    Route::resource('comments', CommentController::class)->only(['update', 'destroy']);

    // admin
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/', [AdminPostController::class, 'index'])->name('index');
        Route::resource('posts', AdminPostController::class);
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard2');
})->name('dashboard');
