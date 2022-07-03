<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Console\Input\Input;

class AjaxController extends Controller
{

    public function index(){

        $data = Posts::orderBy('created_at', 'desc')->take(5)->get();
        $allCards = Cache::remember('Index', now()->addWeek(1), function() use($data){
            return $data;
        });
        return view('index')->with('postsData' , $allCards);
    }

    public function loadMoreData(Request $request)
    {
        if($request->ajax()){
            $allCards = Posts::orderBy('created_at', 'desc')->skip($request->input('count'))->limit(3)->get();
            $html = view('components.ajax')->with(compact('allCards'))->render();
            return response()->json(['success'=>true, 'cards' => $html]);
        }
    }
    public function loadedData(){
        return view('components.ajax');
    }

    public function incrementDecrement(Request $request){
        $id  = $request->input('id');
        $post = Posts::findOrFail($id);
        $counter = $request->input('counter');
        // $sessionId  = session()->getId();
        if($request->ajax()){
            return response()->json(['success'=>true , 'id' =>$id, 'action' => $request->input('action'), 'value'=>$request->input('value')]);
        };
        // if($request->input('action')== "like"){
        //     if($counter % 2 == 0){
        //         if($request->ajax()){
        //             $post = Posts::where('id', '=', $id)->actionPosts()->attach($action,['state'=>rand(true,false),'posts_id'=>$getPost->id, 'users_id'=>$getPost->users_id]);  
        //             $postLikeCount = Posts::where('id', '=', $id)->pluck('like');
        //             return response()->json(['success'=>true , 'id' =>$id, 'count' => $postLikeCount]);
        //         };
        //     }else{
        //         if($request->ajax()){
        //             $post = Posts::where('id', '=', $id)->decrement('like', 1);
        //             $postLikeCount = Posts::where('id', '=', $id)->pluck('like');
        //             return response()->json(['success'=>true , 'id' =>$id, 'count' => $postLikeCount]);
        //         };
        //     }
        // }
        // }else{
        //     if($counter % 2 == 0){
        //         if($request->ajax()){
        //             $post = Posts::where('id', '=', $id)->increment('dislike', 1);
        //             $postDislikeCount = Posts::where('id', '=', $id)->pluck('dislike');
        //             return response()->json(['success'=>true , 'id' =>$id, 'count' => $postDislikeCount]);
        //         };
        //     }else{
        //         if($request->ajax()){
        //             $post = Posts::where('id', '=', $id)->decrement('dislike', 1);
        //             $postDislikeCount = Posts::where('id', '=', $id)->pluck('dislike');
        //             return response()->json(['success'=>true , 'id' =>$id, 'count' => $postDislikeCount]);
        //         };
        //     }
        // }
    }

    public function likeDislike(){
        return view('components.ajax');
    }
}
