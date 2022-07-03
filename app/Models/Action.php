<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    public function postsAction(){
        return $this->belongsToMany('App\Models\Posts', 'posts_action', 'posts_id', 'actions_id', 'users_id')->withTimestamps();
    }
}

// $post->actionPosts()->attach($a,['state'=>false,'posts_id'=>$post->id, 'users_id'=>$post->users_id]);   
// $post->actionPosts()->syncWithoutDetaching($action, [1=>['state'=>false], 2=>['actions_id'=>$action->id], 3 =>['posts_id'=>$post->id], 4 =>['users_id'=>$post->users_id]]);