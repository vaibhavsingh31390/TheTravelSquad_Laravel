<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['image_url', 'title', 'content', 'users_id'];
    public function media(){
        return $this->hasOne('App\Models\Media');
    }
}
