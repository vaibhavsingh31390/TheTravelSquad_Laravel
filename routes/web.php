<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostsController;
use App\Mail\TriggerLikeActionMail;
use App\Models\Action;
use App\Models\Posts;
use App\Models\User;
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

Route::get('/', 'AjaxController@index')->name('home.index'); // INDEX
Route::post('/card-data', 'AjaxController@loadMoreData')->name('home.cardDataPost'); // LOAD DATA INDEX PAGE
Route::post('/card-data-category', 'AjaxController@loadMoreDataOnScroll')->name('home.cardDataScroll'); // LOAD DATA CATEGORY ON SCROLL
Route::post('/send-action', 'AjaxController@incrementDecrement')->middleware('auth')->name('home.like_Dislike_Change'); // LIKE DISLIKE CHECK & ACTION
Route::get('/send-action', 'AjaxController@likeDislike')->middleware('auth')->name('home.like_Dislike'); //LIKE DISLIKE ACTION
Route::resource('posts', PostsController::class)->except('create','edit','destory','update', 'store'); // POSTS RESOURCE
Route::post('posts/new', [PostsController::class, 'create'])->name('user.DashNew'); // POSTS NEW
Route::post('posts/{post}/edit', [PostsController::class, 'edit'])->name('user.DashEdit'); // POSTS EDIT
Route::post('posts/{post}/update', [PostsController::class, 'update'])->name('user.DashUpdate'); // POSTS UPDATE
Route::post('posts/store', [PostsController::class, 'store'])->name('user.DashStore'); // POSTS STORE
Route::post('posts/{post}/destroy', [PostsController::class, 'destroy'])->name('user.DashDelete'); // POSTS DELETE
Route::get('/type/{category?}', 'Controller@category')->name('postByCategory'); // POST BY CATEGORY
Route::post('/dashHome', 'Controller@userDash')->middleware('auth')->name('user.DashHome'); // DASHBOARD HOME 
Route::get('/userDashboard', 'Controller@userDash')->middleware('auth')->name('user.Dashboard'); // DASHBOARD HOME AJAX
Route::post('/userDashboard/{action?}', 'Controller@userDashData')->middleware('auth')->name('user.DashboardDataPost'); // DASHBOARD ALL DATA 
Route::get('/post-comments',  'AjaxController@commentsFetch')->name('get.comment'); // COMMENTS FETCH
Route::post('/post-comments', 'AjaxController@commentsSave')->name('add.comment'); // COMMENTS SAVE
Auth::routes(); // AUTH CONTROLLER

// Route::group('testing', function(){
    
Route::get('alert', [Controller::class, 'test'])->name('testing');
// });
// TESTING

