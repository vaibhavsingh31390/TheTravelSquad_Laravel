<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AjaxController extends Controller
{
    public function index(){
        $allCards = Posts::all();
        return view('index')->with('postsData' , $allCards);
    }

    public function indexData(){
        $allCards = Cache::remember('Index', now()->addWeek(1), function(){
            return Posts::all();
        });
        $html = view('components.test')->with(compact('allCards'))->render();
        return response()->json(['success'=>true, 'cards' => $html]);
    }
}
