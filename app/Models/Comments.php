<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'users_id','commentsable_type','commentsable_id'];

    public function commentsable(){
        return $this->morphTo();
    }

    public function scopeLatestComments(Builder $query){
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
}
