<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment', 'posts_id', 'users_id'
    ];
    public function post(){
        return $this->BelongsTo('App\Models\Posts');
    }

    public function scopeLatestComments(Builder $query){
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
}
