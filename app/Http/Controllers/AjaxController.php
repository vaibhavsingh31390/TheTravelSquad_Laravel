<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Action;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    public function incrementDecrement(Request $request)
    {
        $id  = $request->input('postId');
        $post = Posts::findOrFail($id);
        $loggedUser = $request->input('userId');
        //Duplicate Check
        if (!$post->filterActions(1, $id, $loggedUser)->isEmpty() && $request->input('value') == "true") {
            return response()->json(['success' => true, 'action' => $request->input('action'), 'Message' => "Entry Exists"]);
        } else if (!$post->filterActions(2, $id, $loggedUser)->isEmpty() && $request->input('value') == "true") {
            return response()->json(['success' => true, 'action' => $request->input('action'), 'Message' => "Entry Exists 2nd"]);
        } 
        else {

            if ($request->input('action') == "like") {
                if ($request->input('value') == "true") {
                    $post->actionPosts()->attach(1, ['posts_id' => $post->id, 'users_id' => $loggedUser]);
                    return response()->json(['success' => true, 'action' => $request->input('action'), 'count' => $post->likeCount()->count(), 'Message' => "Attached"]);
                } else {
                    $test = $post->actionPosts()->wherePivot('actions_id', '=', 1)->wherePivot('posts_id', '=', $post->id)->wherePivot('users_id', '=', $loggedUser)->detach();
                    return response()->json(['success' => true, 'action' => $request->input('action'), 'count' => $post->likeCount()->count(),  'Message' => "Detached"]);
                }
            } elseif ($request->input('action') == "dislike") {
                if ($request->input('value') == "true") {
                    $post->actionPosts()->attach(2, ['posts_id' => $post->id, 'users_id' => $loggedUser]);
                    return response()->json(['success' => true, 'action' => $request->input('action'), 'count' => $post->dislikeCount()->count(), 'Message' => "Attached"]);
                } else {
                    $test = $post->actionPosts()->wherePivot('actions_id', '=', 2)->wherePivot('posts_id', '=', $post->id)->wherePivot('users_id', '=', $loggedUser)->detach();
                    return response()->json(['success' => true, 'action' => $request->input('action'), 'count' => $post->dislikeCount()->count(), 'Message' => "Detached"]);
                }
            } else {
                abort(404);
            }

        }
    }

    public function likeDislike(){
        return view('components.ajax');
    }
}
