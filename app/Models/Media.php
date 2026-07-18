<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  
    protected $fillable = ['path'];
    use HasFactory;
    
    public function mediaable(){
        return $this->morphTo();
    }

    public function url(): string
    {
        return asset('storage/'.$this->path);
    }

    public static function placeholderPostUrl(): string
    {
        return asset('assets/placeholder-post.svg');
    }

    public static function placeholderAvatarUrl(): string
    {
        return asset('assets/placeholder-avatar.svg');
    }
}
