<?php

namespace App\Services;

use App\Models\Posts;
use Illuminate\Http\Request;

class AjaxData
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function Load_More_Data_On_Click()
    {
        if ($this->request->ajax()) {
            $allCards = Posts::orderBy('created_at', 'desc')->skip($this->request->input('count'))->limit(6)->get();
            $html = view('components.ajax')->with(compact('allCards'))->render();
            return response()->json(['success' => true, 'cards' => $html]);
        }
    }

    public function Load_More_Data_On_Scroll()
    {
        if ($this->request->ajax()) {
            $category = $this->request->input('categoryType');
            $last_Id = $this->request->input('last_Id');
            if ($this->request->input('categoryType') == 'All Posts') {
                $allCards = Posts::where('id', '>', $last_Id)->limit(6)->get();
                $html = view('components.ajax')->with(compact('allCards'))->render();
                return response()->json(['success' => true, 'cards' => $html]);
            } else {
                $allCards = Posts::whereHas('category', function ($query) use ($category) {
                    $query->where('category_Menu', 'like', '%' . $category . '%');
                })->with('category')->orderBy('created_at', 'desc')->skip($this->request->input('count'))->limit(6)->get();
                $html = view('components.ajax')->with(compact('allCards'))->render();
                return response()->json(['success' => true, 'cards' => $html, 'count' => $this->request->input('count')]);
            }
        }
    }

    public function test()
    {
        $request = $this->request;
        dump($request->request->add(['message' => rand(1, 100)]));
        dd($request->request);
    }
}
