<?php

namespace App\Services;

use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserComments
{

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function Comments_Post()
    {
        if ($this->request->ajax()) {
            $post = Posts::findOrFail($this->request->input('postId'));
            $comment = Comments::create([
                'comment' =>  $this->request->input('formData'),
                'commentsable_type' =>  'App\Models\Posts',
                'commentsable_id' =>  $this->request->input('postId'),
                'users_id' =>  Auth::user()->id
            ]);

            $posts = Posts::find($this->request->input('postId'));
            $comments = $posts->comments()->LatestComments()->get();
            $html = view('components.ajax')->with(compact(['posts', 'comments']))->render();
            return response()->json(['success' => true, 'comments' => $html]);
        }
    }
}
