<?php

namespace App\Services;

use App\Models\Posts;
use App\Models\Tag;
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
        $data = Posts::with(['tags', 'media', 'category'])->orderBy('created_at', 'desc')->take(6)->get();
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
            }, 'tags', 'media', 'category'])->orderByDesc('created_at')->take(6)->get();
        });
        return view('post.posts', ['posts_All' => $posts_All]);
    }

    public function showPost_User($id){
        $post = Posts::with(['tags', 'media', 'category', 'user.media'])->findOrFail($id);
        $comments = $post->comments()->LatestComments()->get();
        $author = $post->user?->name ?? 'Travel Squad';

        return view('post.post', ['posts' => $post, 'author' => $author, 'comments' => $comments]);
    }

    public function posts_Category($category){
        $post_By_Category = Posts::whereHas('category', function ($query) use ($category) {
            $query->where('category_Menu', $category);
        })->with(['category', 'tags', 'media', 'comments'])->orderByDesc('created_at')->take(6)->get();

        return view('post.category', ['post_By_Category' => $post_By_Category, 'categoryName' => $category]);
    }

    public function posts_Search(){
        $q = trim($this->request->query('q', ''));
        if ($q === '') {
            return redirect()->route('posts.index');
        }

        $posts_Search = Posts::query()
            ->where(function ($query) use ($q) {
                $query->where('title', 'LIKE', '%'.$q.'%')
                    ->orWhere('content', 'LIKE', '%'.$q.'%');
            })
            ->with(['comments' => function ($query) {
                return $query->LatestComments();
            }, 'tags', 'media', 'category'])
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('post.search', [
            'posts_Search' => $posts_Search,
            'searchQuery' => $q,
        ]);
    }

    public function posts_By_Tag($tag){
        $tagModel = Tag::where('slug', $tag)->firstOrFail();
        $post_By_Tag = $tagModel->posts()
            ->with(['category', 'tags', 'media', 'comments'])
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('post.tag', [
            'post_By_Tag' => $post_By_Tag,
            'tagName' => $tagModel->name,
            'tagSlug' => $tagModel->slug,
        ]);
    }

    public function about_Page()
    {
        return view('pages.about');
    }

    public function contact_Page()
    {
        return view('pages.contact');
    }

    public function privacy_Page()
    {
        return view('pages.privacy');
    }

    public function terms_Page()
    {
        return view('pages.terms');
    }

    public function test_Page()
    {
        return view('test')->with(['test' => 'success']);
    }
}