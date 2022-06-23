<?php

namespace App\Models;

use App\Scopes\sortByLates;
use App\Scopes\sortByLatest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class Posts extends Model
{
    protected $fillable = ['image_url', 'title', 'content', 'users_id'];
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comments');
    }

    public function category(){
        return $this->hasMany('App\Models\Category');
    }

    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new sortByLatest);

        static::deleting(function(Posts $posts){
            $posts->comments()->delete();
        });


        static::updating(function(Posts $posts){
            Cache::forget('index-postsData');
        });
    }
}
