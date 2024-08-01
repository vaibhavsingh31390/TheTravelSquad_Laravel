<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboard
{

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function home_Post()
    {
        $value = $this->request->input('value');
        if ($this->request->ajax()) {
            $html = view('components.dashboard.dashHome')->render();
            return response()->json(['success' => true, 'Data' => $html]);
        }
        return view('auth.userDashboard');
    }

    public function post_Data_Search()
    {
        $search_Parameter = $this->request->input('value') ?? "";
        $profile = Auth::user();
        $userData = Posts::where('users_id', '=', $profile->id);
        if ($search_Parameter != "") {
            $findIt = $userData->where('title', 'LIKE', '%' . $search_Parameter . '%')->get();
            $findPosts = compact('profile', 'findIt', 'search_Parameter');
            $html = view('components.dashboard.dashTableSearch')->with(compact('findPosts'))->render();
            return response()->json(['success' => true, 'findPosts', 'value' => $search_Parameter, $findPosts, 'search_Data' => $html]);
        } else {
            $findIt = Posts::where('users_id', '=', $profile->id)->get();
            $findPosts = compact('profile', 'findIt', 'search_Parameter');
            $html = view('components.dashboard.dashTableData')->with(compact('findPosts'))->render();
            return response()->json(['success' => true, 'findPosts', $findPosts, 'all_Data' => $html]);
        }
    }

    public function create_Post()
    {
        if ($this->request->ajax()) {
            $html = view('components.dashboard.dashNewPost')->render();
            return response()->json(['success' => true, 'Data' => $html]);
        }
        return abort(404);
    }

    public function store_Post($request)
    {
        if ($request->ajax()) {
            //POST UPDATE
            $validate  = $request->validated();
            $idGet = decrypt($request->input('users_id'));
            if ($idGet != Auth::id()) {
                abort(404);
            };
            $post = Posts::create([
                'id' => $request->id,
                'title' => $request->title,
                'content' => $request->content,
                'users_id' => $idGet
            ]);
            $post->save();
            //CATEGORY UPDATE
            if ($request->category_Menu) {
                $category = $post->category()->create(['category_Menu' => $request->category_Menu]);
            }
            if ($request->hasFile('postImage')) {
                $file = $request->file('postImage')->storeAs('Thumbnails', $post->id . "-" . decrypt($request->users_id) . "-thumbnail." . $request->file('postImage')->extension());
                $post->media()->save(Media::make(['path' => $file]));
            }
            $response_Type_Created = 'Created';
            $message = 'Posts Has Been Created !';
            $html = view('components.alert')->with(compact(['response_Type_Created', 'message']))->render();
            return response()->json(['success' => true, 'formData' => $post, 'responseAlert' => $html]);
        } else {
            $response_Type_Fails = 'Failed';
            $message = 'Request Failed !';
            $html = view('components.alert')->with(compact(['response_Type_Fails', 'message']))->render();
            return response()->json(['success' => true, 'responseAlert' => $html]);
        }
    }

    public function edit_Post($id)
    {
        if ($this->request->ajax()) {
            $id = $this->request->input('id');
            $post = Posts::findOrFail($id);
            $html = view('components.dashboard.dashEditPost')->with(compact(['id', 'post']))->render();
            return response()->json(['success' => true, 'Edit_Data' => $html]);
        }
    }

    public function update_Post($request, $id)
    {
        if ($request->ajax()) {
            //POST UPDATE
            $validate  = $request->validated();
            $post = Posts::findOrFail($request->input('posts_id'));
            $idGet = decrypt($request->input('users_id'));
            if ($idGet != Auth::id()) {
                abort(404);
            }
            $post->fill([
                'title' => $request->title,
                'content' => $request->content,
                'users_id' => $idGet,
            ]);
            $post->save();
            //CATEGORY UPDATE
            if ($request->category_Menu) {
                $category = $post->category()->updateOrCreate(['posts_id' => $post->id], ['category_Menu' => $request->category_Menu]);
                $test = "updated";
            }
            // IMAGE UPDATE
            if ($request->hasFile('postImage')) {
                $file = $request->file('postImage')->storeAs('Thumbnails', $post->id . "-" . $idGet . "-thumbnail." . $request->file('postImage')->extension());
                $post->media()->save(Media::updateOrCreate([], ['path' => $file,]));
            }
            // Response Alerts
            $response_Type_Updated = 'Updated';
            $message = 'Posts Has Been Updated !';
            $html = view('components.alert')->with(compact(['response_Type_Updated', 'message']))->render();
            return response()->json(['success' => true, 'formData' => $post, 'responseAlert' => $html]);
        } else {
            $response_Type_Fails = 'Failed';
            $message = 'Request Failed !';
            $html = view('components.alert')->with(compact(['response_Type_Fails', 'message']))->render();
            return response()->json(['success' => true, 'responseAlert' => $html]);
        }
    }

    public function destroy_Post($id)
    {
        if ($this->request->ajax()) {
            $id = $this->request->input('id');
            $deletePost = Posts::findOrFail($id);
            $deletePost->category()->delete();
            $deletePost->comments()->delete();
            $deletePost->delete();
            return response()->json(['success' => true]);
        }
    }
}
