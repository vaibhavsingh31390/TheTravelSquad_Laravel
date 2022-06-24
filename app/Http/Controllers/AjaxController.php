<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AjaxController extends Controller
{

    public function index(){

        $data = Posts::paginate(5);
        // Cache::forget('Index');
        $allCards = Cache::remember('Index', now()->addWeek(1), function() use($data){
            return $data;
        });
        return view('index')->with('postsData' , $allCards);
    }

    public function loadMoreData(Request $request)
    {
        if($request->ajax()){
            $allCards = Posts::skip(5)->paginate(2);
            $html = view('components.ajaxCard')->with(compact('allCards'))->render();
            return response()->json(['success'=>true, 'cards' => $html]);
        }
    }

    public function loadedData(){
        return view('components.ajaxCard');
    }
}
