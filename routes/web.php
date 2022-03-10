<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\PostController;
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

Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [AdminPostController::class, 'index'])->name('index');


    Route::prefix('posts')->name('posts.')->group(function(){
        Route::get('/', [AdminPostController::class, 'posts'])->name('index');
        Route::get('/edit/{post}', [AdminPostController::class, 'edit'])->name('edit');
        Route::get('/create', [AdminPostController::class, 'create'])->name('create');
        Route::post('/store', [AdminPostController::class, 'store'])->name('store');
        Route::post('/update/{post}', [AdminPostController::class, 'update'])->name('update');
        Route::post('/delete/{post}', [AdminPostController::class, 'destroy'])->name('destroy');
    });
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
