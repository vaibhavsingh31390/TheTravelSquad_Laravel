<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
        $allCards = Posts::all();
        return view('index')->with('postsData' , $allCards);
    }

    public function category($category){
        $categoryCards =  Posts::whereHas('category', function($query) use($category) {$query->where('category_Menu', 'like', '%'.$category.'%');})->with('category')->get(); 
        return view('post.category', ['cardsData'=>$categoryCards]);
    }

    public function userDash(){
        $userData = Auth::user();
        return view('auth.userDashboard')->with('userData', $userData);
    }
}

