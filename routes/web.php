<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'index'])->name('home.index');
Route::get('/about', [Controller::class, 'about'])->name('pages.about');
Route::get('/contact', [Controller::class, 'contact'])->name('pages.contact');
Route::get('/privacy-policy', [Controller::class, 'privacy'])->name('pages.privacy');
Route::get('/terms-of-service', [Controller::class, 'terms'])->name('pages.terms');
Route::get('/sitemap.xml', [Controller::class, 'sitemap'])->name('sitemap');
Route::post('/card-data', [AjaxController::class, 'loadMoreData'])->name('home.cardDataPost');
Route::post('/card-data-category', [AjaxController::class, 'loadMoreDataOnScroll'])->name('home.cardDataScroll');
Route::post('/send-action', [AjaxController::class, 'incrementDecrement'])->middleware('auth')->name('home.like_Dislike_Change');
Route::get('/send-action', [AjaxController::class, 'likeDislike'])->middleware('auth')->name('home.like_Dislike');
Route::get('tags/search', [PostsController::class, 'searchTags'])->middleware('auth')->name('tags.search');
Route::resource('posts', PostsController::class)->except('create', 'edit', 'destory', 'update', 'store');
Route::post('posts/new', [PostsController::class, 'create'])->name('user.DashNew');
Route::post('posts/{post}/edit', [PostsController::class, 'edit'])->name('user.DashEdit');
Route::post('posts/{post}/update', [PostsController::class, 'update'])->name('user.DashUpdate');
Route::post('posts/store', [PostsController::class, 'store'])->name('user.DashStore');
Route::post('editor/upload-image', [PostsController::class, 'uploadEditorImage'])->middleware('auth')->name('editor.upload');
Route::post('posts/{post}/destroy', [PostsController::class, 'destroy'])->name('user.DashDelete');
Route::get('/type/{category?}', [Controller::class, 'category'])->name('postByCategory');
Route::get('/tag/{tag}', [Controller::class, 'tag'])->name('postByTag');
Route::post('/dashHome', [Controller::class, 'userDash'])->middleware('auth')->name('user.DashHome');
Route::get('/userDashboard', [Controller::class, 'userDash'])->middleware('auth')->name('user.Dashboard');
Route::post('/userDashboard/{action?}', [Controller::class, 'userDashData'])->middleware('auth')->name('user.DashboardDataPost');
Route::get('/post-comments', [AjaxController::class, 'commentsFetch'])->name('get.comment');
Route::post('/post-comments', [AjaxController::class, 'commentsSave'])->name('add.comment');
Auth::routes();

Route::get('alert', [Controller::class, 'test'])->name('testing');
