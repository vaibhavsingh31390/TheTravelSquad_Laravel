<?php

namespace App\Models;

use App\Scopes\sortByLates;
use App\Scopes\sortByLatest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Posts extends Model
{
    protected $fillable = ['postImage', 'title', 'content', 'users_id'];
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User', 'users_id');
    }
    public function comments(){
        return $this->morphMany('App\Models\Comments', 'commentsable');
    }

    public function category(){
        return $this->hasMany('App\Models\Category');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tag', 'posts_id', 'tag_id')->withTimestamps();
    }

    public function media(){
        return $this->morphOne('App\Models\Media', 'mediaable');
    }

    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function actionPosts(){
        return $this->belongsToMany('App\Models\Action', 'posts_action', 'posts_id', 'actions_id')->withPivot('users_id')->withTimestamps();
    }

    public function likeCount(){
        return $this->actionPosts()->wherePivot('actions_id','=', 1);
    }

    public function dislikeCount(){
        return $this->actionPosts()->wherePivot('actions_id','=', 2);
    }
    public function filterActions($action, $post, $user){
        return $this->actionPosts()->wherePivot('actions_id','=', $action)->wherePivot('posts_id','=', $post)->wherePivot('users_id','=', $user)->get();
    }

    public static function totalLikesForUser(int $userId): int
    {
        return (int) DB::table('posts_action')
            ->join('posts', 'posts.id', '=', 'posts_action.posts_id')
            ->where('posts.users_id', $userId)
            ->where('posts_action.actions_id', 1)
            ->count();
    }
}
