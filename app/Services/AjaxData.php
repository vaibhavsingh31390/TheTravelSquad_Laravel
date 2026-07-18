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
        if (! $this->request->ajax()) {
            return;
        }

        $offset = (int) $this->request->input('count', 6);
        $limit = 6;

        $allCards = Posts::orderBy('created_at', 'desc')->skip($offset)->limit($limit)->get();
        $html = view('components.ajax')->with(compact('allCards'))->render();

        return response()->json([
            'success' => true,
            'cards' => $html,
            'hasMore' => $allCards->count() === $limit,
            'nextOffset' => $offset + $allCards->count(),
        ]);
    }

    public function Load_More_Data_On_Scroll()
    {
        if (! $this->request->ajax()) {
            return;
        }

        $category = $this->request->input('categoryType', 'All Posts');
        $tagSlug = $this->request->input('tagSlug');
        $offset = (int) $this->request->input('count', 6);
        $limit = 6;

        $query = Posts::query()->orderBy('created_at', 'desc');

        if ($tagSlug) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        } elseif ($category !== 'All Posts' && $category !== 'All') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('category_Menu', $category);
            });
        }

        $allCards = $query->with(['tags', 'media', 'category'])->skip($offset)->limit($limit)->get();
        $html = view('components.ajax')->with(compact('allCards'))->render();

        return response()->json([
            'success' => true,
            'cards' => $html,
            'hasMore' => $allCards->count() === $limit,
            'nextOffset' => $offset + $allCards->count(),
        ]);
    }

    public function test()
    {
        $request = $this->request;
        dump($request->request->add(['message' => rand(1, 100)]));
        dd($request->request);
    }
}
