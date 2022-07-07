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
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $data = Posts::orderBy('created_at', 'desc')->take(6)->get();
        $allCards = Cache::remember('Index', now()->addWeek(1), function() use($data){
            return $data;
        });
        return view('index')->with('postsData' , $allCards);
    }

    public function category($category){

        $categoryCards = Cache::remember('Post_By_Category', now()->addMinutes(10), function() use ($category){
            return Posts::whereHas('category', function($query) use($category) {$query->where('category_Menu', 'like', '%'.$category.'%');})->with('category')->get(); 
        });
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
            $findIt = Posts::where('users_id', '=', $profile->id)->get();
        }
        $findPosts = compact('profile', 'findIt', 'search_Parameter');
        // dd($findPosts);
        return view('auth.userDashboard')->with('findPosts', $findPosts);
    }
}

