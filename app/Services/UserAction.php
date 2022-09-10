<?php

namespace App\Services;

use App\Models\Posts;
use App\Events\LikedPost;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class UserAction
{

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function User_Take_Action()
    {
        $id  = $this->request->input('postId');
        $post = Posts::findOrFail($id);
        $loggedUser = Auth::user()->id;
        $like = false;
        $userAction = User::find($loggedUser);
        //Duplicate Check
        if (!$post->filterActions(1, $id, $loggedUser)->isEmpty() && $this->request->input('value') == "true") {
            return response()->json(['success' => true, 'action' => $this->request->input('action'), 'Message' => "Entry Exists"]);
        } else if (!$post->filterActions(2, $id, $loggedUser)->isEmpty() && $this->request->input('value') == "true") {
            return response()->json(['success' => true, 'action' => $this->request->input('action'), 'Message' => "Entry Exists 2nd"]);
        } else {
            if ($this->request->input('action') == "like") {
                if ($this->request->input('value') == "true") {
                    $post->actionPosts()->attach(1, ['posts_id' => $post->id, 'users_id' => $loggedUser]);
                    event(new LikedPost($post, $userAction));
                    return response()->json(['success' => true, 'action' => $this->request->input('action'), 'count' => $post->likeCount()->count(), 'Message' => "Attached"]);
                } else {
                    $test = $post->actionPosts()->wherePivot('actions_id', '=', 1)->wherePivot('posts_id', '=', $post->id)->wherePivot('users_id', '=', $loggedUser)->detach();
                    return response()->json(['success' => true, 'action' => $this->request->input('action'), 'count' => $post->likeCount()->count(),  'Message' => "Detached"]);
                }
            } elseif ($this->request->input('action') == "dislike") {
                if ($this->request->input('value') == "true") {
                    $post->actionPosts()->attach(2, ['posts_id' => $post->id, 'users_id' => $loggedUser]);
                    return response()->json(['success' => true, 'action' => $this->request->input('action'), 'count' => $post->dislikeCount()->count(), 'Message' => "Attached"]);
                } else {
                    $post->actionPosts()->wherePivot('actions_id', '=', 2)->wherePivot('posts_id', '=', $post->id)->wherePivot('users_id', '=', $loggedUser)->detach();
                    return response()->json(['success' => true, 'action' => $this->request->input('action'), 'count' => $post->dislikeCount()->count(), 'Message' => "Detached"]);
                }
            } elseif ($this->request->input('action') == "verify") {
                return response()->json(['success' => true, 'likeCount' => $post->filterActions(1, $post->id, $loggedUser), 'dislikeCount' => $post->filterActions(2, $post->id, $loggedUser)]);
            } else {
                abort(404);
            }
        }
        // if($like == true){

        // }
    }
}
