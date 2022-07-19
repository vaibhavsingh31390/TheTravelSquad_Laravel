<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use App\Models\Posts;
use App\Models\Category;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $posts =  Cache::remember('index-postsData', now()->addMinutes(10), function () {
            return Posts::with(['comments' => function ($query) {
                return $query->LatestComments();
            }])->get();
        });
        return view('post.posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.userDashboard', ['action' => 'newPosts']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validate  = $request->validated();
        $post = Posts::create([
            'id' => $request->id,
            'title' => $request->title,
            'content' => $request->content,
            'users_id' => decrypt($request->users_id)
        ]);
        $category = $post->category()->create(['category_Menu' => $request->category_Menu]);
        if ($request->hasFile('postImage')) {
            $file = $request->file('postImage')->storeAs('Thumbnails', $post->id."-".decrypt($request->users_id)."-thumbnail.".$request->file('postImage')->extension());
            if($post->media()){
                Storage::delete($post->image->path);
                $post->media->path = $file;
                $post->media->save();
                $post->media()->save(
                    Media::create(['path'=>$file])
                );
            }else{
                $post->media()->save(
                    Media::create(['path'=>$file])
                );
            }
        }
        return redirect()->route('user.Dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Cat = Category::pluck('category_Menu');
        $findName = Posts::where('id', '=', $id)->pluck('users_id');
        $author = User::where('id', '=', $findName)->get();
        $data = compact('Cat', 'author');
        return view('post.post', ['posts' => Posts::findOrFail($id), 'Data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $post = Posts::findOrFail($id);
            $html = view('components.dashboard.dashEditPost')->with(compact(['id', 'post']))->render();
            return response()->json(['success' => true, 'Edit_Data' => $html]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = Posts::findOrFail($id);
        $validated = $request->validated();
        $idGet = decrypt($validated['users_id']);
        if ($idGet != Auth::id()) {
            abort(404);
        }
        $validated['users_id'] = $idGet;
        $post->fill($validated);
        if ($post->category->count() > 1) {
            $post->category()->update(['category_Menu' => $request->category_Menu]);
        } else {
            $post->category()->create(['category_Menu' => $request->category_Menu]);
        }
        $post->save();
        return redirect()->route('user.Dashboard', ['action' => 'myPosts']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {

            $id = $request->input('id');
            $deletePost = Posts::findOrFail($id);
            $deletePost->category()->delete();
            $deletePost->comments()->delete();
            $deletePost->delete();
            return response()->json(['success' => true]);
        }
        // return redirect()->route('user.Dashboard', ['action' => 'myPosts']);
    }
}
