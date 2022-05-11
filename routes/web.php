<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostsController;
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
Route::get('/layout', [Controller::class, 'layout'])->name('header');
Route::get('/', [Controller::class, 'home'])->name('home.index');
Route::resource('posts', PostsController::class)->only('index', 'show');

Route::get('/type/{category?}', [Controller::class, 'category'])->name('postByCategory');
Route::get('/userDashboard', [Controller::class, 'userDash'])->name('user.Dashboard');

Auth::routes();