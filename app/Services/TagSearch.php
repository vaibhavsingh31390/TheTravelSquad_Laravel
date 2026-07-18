<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Str;

class TagSearch
{
    public function suggest(?string $query, int $limit = 10): array
    {
        $query = trim((string) $query);

        $builder = Tag::query()
            ->withCount('posts')
            ->orderByDesc('posts_count')
            ->orderBy('name');

        if ($query !== '') {
            $slug = Str::slug($query);
            $builder->where(function ($q) use ($query, $slug) {
                $q->where('name', 'LIKE', '%'.$query.'%');
                if ($slug !== '') {
                    $q->orWhere('slug', 'LIKE', '%'.$slug.'%');
                }
            });
        }

        return $builder
            ->limit($limit)
            ->pluck('name')
            ->all();
    }
}
