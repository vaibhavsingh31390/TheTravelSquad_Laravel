<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment', 'posts_id'
    ];
    public function post(){
        return $this->BelongsTo('App\Models\Posts');
    }
}
