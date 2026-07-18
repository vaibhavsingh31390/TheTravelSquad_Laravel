<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Posts;
use App\Models\Tag;

class Sitemap
{
    public function xml_Response()
    {
        $posts = Posts::select('id', 'updated_at')->orderByDesc('updated_at')->get();
        $categories = Category::query()->distinct()->pluck('category_Menu')->unique()->filter();
        $tags = Tag::orderBy('name')->get();

        return response()
            ->view('sitemap', compact('posts', 'categories', 'tags'))
            ->header('Content-Type', 'application/xml');
    }
}
