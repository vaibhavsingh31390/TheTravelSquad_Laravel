<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostsController;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', 'Controller@home')->name('home.index');
Route::resource('posts', PostsController::class);
Route::get('/type/{category?}', 'Controller@category')->name('postByCategory');
Route::get('/userDashboard/{action?}', 'Controller@userDash')->middleware('auth')->name('user.Dashboard');
Auth::routes();
Route::put('posts/{id}/post-comments', [PostsController::class, 'addComment'])->name('add.comment');