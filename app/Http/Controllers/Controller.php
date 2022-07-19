<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Posts;
use App\Models\User;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        Cache::forget('Index');
        $data = Posts::orderBy('created_at', 'desc')->take(6)->get();
        $allCards = Cache::remember('Index', now()->addWeek(1), function() use($data){
            return $data;
        });
        return view('index')->with('postsData' , $allCards);
    }

    public function category($category){
        $categoryCards =  Posts::whereHas('category', function($query) use($category) {$query->where('category_Menu', 'like', '%'.$category.'%');})->with('category')->get(); 
        return view('post.category', ['cardsData'=>$categoryCards]);
    }

    public function userDash(Request $request){
        $value = $request->input('value');
        if($request->ajax()){
            if($value == "Home"){
                $html = view('components.dashboard.dashHome')->render();
                return response()->json(['success'=>true, 'Data' => $html]);
            }elseif($value == "NewPost"){
                $html = view('components.dashboard.dashNewPost')->render();
                return response()->json(['success'=>true, 'Data' => $html]);
            }          
        }
        return view('auth.userDashboard');
    }

    public function userDashNewPost(Request $request){
        if($request->ajax()){
            $html = view('components.dashboard.dashHome')->render();
            return response()->json(['success'=>true, 'Data' => $html]);
        }
        return view('auth.userDashboard');
    }

    public function userDashData(Request $request){
        $search_Parameter = $request->input('value') ?? "";
        $profile = Auth::user();
        $userData = Posts::where('users_id', '=', $profile->id);
        if($search_Parameter != ""){
            $findIt = $userData->where('title', 'LIKE', '%'.$search_Parameter.'%')->get();
            $findPosts = compact('profile', 'findIt', 'search_Parameter');
            $html = view('components.dashboard.dashTableSearch')->with(compact('findPosts'))->render();
            return response()->json(['success'=>true, 'findPosts', 'value' => $search_Parameter, $findPosts, 'search_Data' => $html]);
        }
        else{
            $findIt = Posts::where('users_id', '=', $profile->id)->get();
            $findPosts = compact('profile', 'findIt', 'search_Parameter');
            $html = view('components.dashboard.dashTableData')->with(compact('findPosts'))->render();
            return response()->json(['success'=>true, 'findPosts', $findPosts, 'all_Data' => $html]);
        }
        
    }

    public function test(){
        // $test = File::files('C:\xampp\htdocs\thetravelsquad\public');
        $test = Storage::files('Sample_Thumbnails');
        $randomImages = array_rand($test);
        $randomImage = $test[$randomImages];
        return view('test')->with(['test'=>$randomImage]);
    }
}

