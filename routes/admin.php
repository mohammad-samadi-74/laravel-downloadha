<?php

use Illuminate\Support\Facades\Route;



Route::get('admin-panel',function(){ return view('admin.admin'); })->name('admin');

// posts
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('posts',\App\Http\Controllers\Admin\PostController::class)->except('show');
    Route::get('post/{post}/info',[\App\Http\Controllers\Admin\PostController::class,'info'])->name('posts.info');
    Route::get('post/{post}/info/comments',[\App\Http\Controllers\Admin\PostController::class,'commentsInfo'])->name('posts.comments.info');
});

// products
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('products',\App\Http\Controllers\Admin\ProductController::class)->except('show');
    Route::get('product/{product}/info',[\App\Http\Controllers\Admin\ProductController::class,'info'])->name('products.info');
    Route::get('product/{product}/info/comments',[\App\Http\Controllers\Admin\ProductController::class,'commentsInfo'])->name('products.comments.info');
    Route::post('attribute/values',[\App\Http\Controllers\Admin\ProductController::class,'attribute_values']);
});

// users
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('users',\App\Http\Controllers\Admin\UserController::class)->except('show');
    Route::get('user/{user}/info',[\App\Http\Controllers\Admin\UserController::class,'userInfo'])->name('users.info');
});

//categories
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class)->except('show');
});

//comments
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('comments',\App\Http\Controllers\Admin\CommentController::class)->except(['show','create','store']);
    Route::post('comment/{post}/{user}',[\App\Http\Controllers\Admin\CommentController::class,'store'])->name('store.comment');
    Route::get('unapproved',[\App\Http\Controllers\Admin\CommentController::class,'unapproved'])->name('comments.unapproved');
    Route::get('approved/{comment}',[\App\Http\Controllers\Admin\CommentController::class,'approved'])->name('comments.approved');
});

//permissions
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('permissions',\App\Http\Controllers\Admin\PermissionController::class)->except('show');
});

//rules
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('rules',\App\Http\Controllers\Admin\RuleController::class)->except('show');
    Route::get('rules/{rule}/info',[\App\Http\Controllers\Admin\RuleController::class , 'info'])->name('rules.info');
    Route::get('rules/set-rule/{user}',[\App\Http\Controllers\Admin\RuleController::class , 'setRule'])->name('rules.setRule');
    Route::patch('rules/edit-rule/{user}',[\App\Http\Controllers\Admin\RuleController::class , 'editRule'])->name('rules.editRule');
});

//orders
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('orders',\App\Http\Controllers\Admin\OrderController::class)->except(['show','create','store']);
    Route::get('orders/{order}/info',[\App\Http\Controllers\Admin\OrderController::class , 'info'])->name('orders.info');
});

//payments
Route::resource('admin/payments',\App\Http\Controllers\Admin\PaymentController::class)->only(['index']);


//addresses
Route::resource('admin/address',\App\Http\Controllers\Admin\AddressController::class)->except(['index','create','store','show']);

