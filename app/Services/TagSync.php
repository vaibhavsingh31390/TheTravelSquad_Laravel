<?php

namespace App\Services;

use App\Models\Posts;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSync
{
    public static function syncFromInput(Posts $post, ?string $tagsInput): void
    {
        $names = self::parseInput($tagsInput);

        if ($names->isEmpty()) {
            $post->tags()->detach();

            return;
        }

        $tagIds = $names
            ->take(8)
            ->map(fn (string $tag) => Tag::findOrCreateFromName($tag)->id)
            ->values()
            ->all();

        $post->tags()->sync($tagIds);
    }

  /**
     * @return \Illuminate\Support\Collection<int, string>
     */
    public static function parseInput(?string $tagsInput): \Illuminate\Support\Collection
    {
        if ($tagsInput === null || trim($tagsInput) === '') {
            return collect();
        }

        $trimmed = trim($tagsInput);

        if (str_starts_with($trimmed, '[')) {
            $decoded = json_decode($trimmed, true);
            if (is_array($decoded)) {
                return collect($decoded)
                    ->map(function ($item) {
                        if (is_array($item)) {
                            return trim((string) ($item['value'] ?? $item['name'] ?? ''));
                        }

                        return trim((string) $item);
                    })
                    ->filter()
                    ->unique()
                    ->filter(fn (string $tag) => strlen($tag) <= 50)
                    ->values();
            }
        }

        return collect(preg_split('/\s*,\s*/', $trimmed) ?: [])
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->unique()
            ->filter(fn (string $tag) => strlen($tag) <= 50)
            ->values();
    }

    public static function slugify(string $value): string
    {
        return Str::slug($value);
    }
}
