<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Posts::class, 'post_tag', 'tag_id', 'posts_id')->withTimestamps();
    }

    public static function findOrCreateFromName(string $name): self
    {
        $name = trim($name);
        $slug = Str::slug($name);

        if ($slug === '') {
            throw new \InvalidArgumentException('Tag name must contain at least one alphanumeric character.');
        }

        return static::firstOrCreate(
            ['slug' => $slug],
            ['name' => $name]
        );
    }
}
