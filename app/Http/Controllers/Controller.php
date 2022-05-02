<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
        $CARDS = Posts::all();
        return view('index')->with('DATA' , $CARDS);
    }

    public function category($category){
        $CARDS =  Posts::whereHas('category', function($query) use($category) {$query->where('category_Menu', 'like', '%'.$category.'%');})->with('category')->get(); 
        return view('post.category', ['CARDS'=>$CARDS]);
    }

    public function login(){
        return view('admin.login');
    }
}

