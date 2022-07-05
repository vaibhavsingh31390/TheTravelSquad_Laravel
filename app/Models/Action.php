<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    public function postsAction(){
        return $this->belongsToMany('App\Models\Posts', 'posts_action', 'posts_id', 'actions_id')->withTimestamps();
    }

    public function postsUsers(){
        return $this->belongsToMany('App\Models\Users', 'posts_action', 'posts_id', 'actions_id')->withTimestamps();
    }
}
