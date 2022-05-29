<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use App\Models\User;
use Egulias\EmailValidator\Parser\Comment;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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
        $search_Parameter = $_GET['search_Query'] ?? "";
        $profile = Auth::user();
        $userData = Posts::where('users_id', '=', $profile->id);
        if($search_Parameter != ""){
            $findIt = $userData->where('title', 'LIKE', '%'.$search_Parameter.'%')->get();
        }
        else{
            $findIt = Posts::where('users_id', '=', $profile->id)->with('category')->get();
        }
        $findPosts = compact('profile', 'findIt', 'search_Parameter');
        // dd($findPosts);
        return view('auth.userDashboard')->with('findPosts', $findPosts);
    }
}

