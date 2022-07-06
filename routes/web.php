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
Route::get('/', 'AjaxController@index')->name('home.index');
Route::get('/card-data', 'AjaxController@loadedData')->name('home.cardDataGet');
Route::post('/card-data', 'AjaxController@loadMoreData')->name('home.cardDataPost');
Route::post('/send-action', 'AjaxController@incrementDecrement')->middleware('auth')->name('home.like_Dislike_Change');
Route::get('/send-action', 'AjaxController@likeDislike')->middleware('auth')->name('home.like_Dislike');
Route::resource('posts', PostsController::class);
Route::get('/type/{category?}', 'Controller@category')->name('postByCategory');
Route::get('/userDashboard/{action?}', 'Controller@userDash')->middleware('auth')->name('user.Dashboard');
Auth::routes();
Route::post('/post-comments', 'AjaxController@commentsSave')->name('add.comment');
Route::get('/post-comments',  'AjaxController@commentsFetch')->name('get.comment');