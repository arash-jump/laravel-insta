<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AdminController;

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class,'index'])->name('index');

    //Post
    Route::group(['prefix' => 'post' , 'as' => 'post.'], function(){
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/save', [PostController::class, 'save'])->name('save');
        Route::get('/{id}/show', [PostController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PostController::class,'destroy'])->name('destroy');
    });

    //Comment
    Route::group(['prefix' => 'comment' , 'as' => 'comment.'], function(){
        Route::post('/{id}/save', [CommentController::class,'save'])->name('save');
        Route::get('/{id}/destroy', [CommentController::class, 'destroy'])->name('destroy');
    });

    //Like
    Route::group(['prefix' => 'like' , 'as' => 'like.'], function(){
        Route::get('/{id}/save', [LikeController::class,'save'])->name('save');
        Route::delete('/{id}/delete', [LikeController::class,'delete'])->name('delete');
    });

    //Account
    Route::group(['prefix' => 'account' , 'as' => 'account.'], function(){
        Route::get('/{id}/show', [UserController::class, 'show_account'])->name('show');
        Route::get('/{id}/follow', [FollowController::class, 'add'])->name('follow');
        Route::delete('/{id}/unfollow', [FollowController::class, 'delete'])->name('unfollow');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [UserController::class, 'update'])->name('update');
    });

    //Admin
    Route::group(['middleware' => 'role'], function(){
        Route::group(['prefix' => 'admin' , 'as' => 'admin.'], function(){
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::delete('/{id}/inactive',[AdminController::class, 'inactive'])->name('inactive');
            Route::get('/{id}/active' ,[AdminController::class, 'active'])->name('active');
            Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
            Route::delete('/{id}/hidden', [AdminController::class, 'hidden'])->name('hidden');
            Route::get('/{id}/republic', [AdminController::class, 'republic'])->name('republic');
            Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
            Route::post('/add', [AdminController::class, 'add'])->name('add');
            Route::patch('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::delete('/{id}/delete', [AdminController::class, 'delete'])->name('delete');
        });
    });
});

