<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
