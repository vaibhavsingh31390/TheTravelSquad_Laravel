<?php

namespace App\Services;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Pages{

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function indexPage_User(){
        Cache::forget('Index');
        $data = Posts::orderBy('created_at', 'desc')->take(6)->get();
        $allCards = Cache::remember('Index', now()->addWeek(1), function() use($data){
            return $data;
        });
        return view('index')->with('postsData' , $allCards);
    }
    public function posts_All(){
        Cache::forget('Index');
        $posts_All =  Cache::remember('index-postsData', now()->addMinutes(10), function () {
            return Posts::with(['comments' => function ($query) {
                return $query->LatestComments();
            }])->take(6)->get();
        });
        return view('post.posts', ['posts_All' => $posts_All]);
    }

    public function showPost_User($id){
        $post = Posts::findOrFail($id);
        $findName = $post->users_id;
        $comments = $post->comments()->LatestComments()->get();
        $author = User::where('id', '=', $findName)->pluck('name');
        return view('post.post', ['posts' => $post, 'author' => $author->first(), 'comments' => $comments]);
    }

    public function posts_Category($category){
        $post_By_Category =  Posts::whereHas('category', function($query) use($category) {$query->where('category_Menu', 'like', '%'.$category.'%');})->with('category')->take(6)->get(); 
        return view('post.category', ['post_By_Category'=>$post_By_Category]);
    }
}