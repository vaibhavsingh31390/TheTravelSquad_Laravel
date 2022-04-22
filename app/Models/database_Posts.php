<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class database_Posts extends Model
{
    use HasFactory;

    public function comment(){
        return $this->hasMany('App\Models\database_Comments');
    }

    public function categories(){
        return $this->hasOne('App\Models\database_Categories');
    }
    
}
